<?php

use PHPUnit\Framework\TestCase;

final class UsersTest extends TestCase
{
    public function setUp()
    {
        $_SERVER['DOCUMENT_ROOT'] = dirname(__FILE__) . "/../";
        include_once $_SERVER['DOCUMENT_ROOT'] . 'includes/classes/Core.php';
        include_once $_SERVER['DOCUMENT_ROOT'] . 'includes/classes/Users.php';
    }
    public function tearDown()
    {
        unset($_SERVER['DOCUMENT_ROOT']);
        if (isset($_SESSION['user'])) {
            @session_destroy();
            unset($_SESSION);
        }
    }
    public function testgetUsersCount(): void
    {
        $db = new PDO("mysql:host=127.0.0.1;dbname=phparcade", 'root', '');

        $stmt = $db->prepare('CALL sp_Members_GetAllIDs();');
        $stmt->execute();

        $rows = $db->query('SELECT FOUND_ROWS();')->fetchColumn();
        $this->assertEquals(0, $rows);
    }
    public function testGetGravatar(): void
    {
        $email = 'test@example.com';
        $this->assertEquals('55502f40dc8b7c769880b10874abc9d0', md5(strtolower(trim($email))));
    }
    public function testStartSession(): void
    {
        /* Suppress errors with session_start */
        @session_start();
        $_SESSION['user'] = array( 'name' => 'testuser');
        $this->assertEquals('testuser', $_SESSION['user']['name']);
    }
    public function testUserAdd(): void
    {
        $db = new PDO("mysql:host=127.0.0.1;dbname=phparcade", 'root', '');

        $id = 7;
        $username = 'travis1';
        $password = '6a204bd89f3c8348afd5c77c717a097a';
        $email = 'travis1@example.com';
        $yes = 'yes';
        $no = 'no';
        $ip = '127.0.0.1';

        $stmt =
            $db->prepare('CALL sp_Members_AddMember(:memberid, :memberusername, :memberpassword, :memberemail, :memberactive, :memberadmin, :memberip);');
        $stmt->bindParam(':memberid', $id);
        $stmt->bindParam(':memberusername', $username);
        $stmt->bindParam(':memberpassword', $password);
        $stmt->bindParam(':memberemail', $email);
        $stmt->bindParam(':memberactive', $yes);
        $stmt->bindParam(':memberadmin', $no);
        $stmt->bindParam(':memberip', $ip);
        $stmt->execute();

        $rows = $db->query('SELECT * FROM members;')->rowCount();
        $this->assertEquals('1', $rows);
    }
    public function testUserDelete(): void
    {
        $db = new PDO("mysql:host=127.0.0.1;dbname=phparcade", 'root', '');

        $id = 400;
        $admin = 'no';

        $stmt = $db->prepare('CALL sp_Members_DeleteMember(:memberid, :admin);');
        $stmt->bindParam(':memberid', $id);
        $stmt->bindParam(':admin', $admin);
        $stmt->execute();

        $rows = $db->query('SELECT FOUND_ROWS();')->fetchColumn();
        $this->assertEquals(0, $rows);
    }
    public function testUserPasswordHash(): void
    {
        $hash = password_hash('password', PASSWORD_DEFAULT);
        $this->assertEquals($hash, crypt('password', $hash));
    }
    public function testUserPasswordGenerate(): void
    {
        $password = 'password';
        $this->assertEquals('70617373776f7264', bin2hex($password));
    }
    public function testUserPasswordMD5(): void
    {
        $password = 'password';
        $this->assertEquals('5f4dcc3b5aa765d61d8327deb882cf99', md5($password));
    }
}
