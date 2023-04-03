<?php

use PHPUnit\Framework\TestCase;
use Modele\AccesUtilisateur;
use Modele\AccesDonnees;

include_once('Modele/AccesUtilisateur.php');
include_once('Modele/AccesDonnees.php');


class AccesUtilisateurTest extends TestCase
{

    protected $accesDonneesMock;

    protected function setUp(): void
    {
        $this->accesDonneesMock = $this->createMock(AccesDonnees::class);
    }

    public function testConnexionWithCorrectCredentials()
    {
        $accesUtilisateur = new AccesUtilisateur($this->accesDonneesMock);
        $mockResult = [['mot_de_passe' => password_hash('test', PASSWORD_DEFAULT)]];
        $this->accesDonneesMock
            ->method('run')
            ->willReturn($mockResult);

        $accesUtilisateur->connexion('test', 'test');
        $this->assertEquals(true, $_SESSION['connecte']);
        $this->assertEquals('test', $_SESSION['login']);
    }

    public function testConnexionWithIncorrectCredentials()
    {
        $accesUtilisateur = new AccesUtilisateur($this->accesDonneesMock);
        $this->accesDonneesMock
            ->method('run')
            ->willReturn([]);

        ob_start();
        $accesUtilisateur->connexion('test', 'test');
        $output = ob_get_clean();

        $this->assertEquals(false, $_SESSION['connecte']);
        $this->assertStringContainsString('Identifiant invalide', $output);
    }

    public function testInscriptionWithShortPassword()
    {
        $accesUtilisateur = new AccesUtilisateur($this->accesDonneesMock);
        $password = 'test';
        $username = 'test';

        ob_start();
        $accesUtilisateur->inscription($username, $password, $password);
        $output = ob_get_clean();

        $this->assertStringContainsString('Le mot de passe doit comporter au moins 8 caract', $output);
    }

    public function testInscriptionWithLongUsername()
    {
        $accesUtilisateur = new AccesUtilisateur($this->accesDonneesMock);
        $password = 'testPassword1#';
        $username = '0123456789A';

        ob_start();
        $accesUtilisateur->inscription($username, $password, $password);
        $output = ob_get_clean();

        $this->assertStringContainsString('Le pseudo est trop long', $output);
    }

    public function testInscriptionWithWeakPassword()
    {
        $accesUtilisateur = new AccesUtilisateur($this->accesDonneesMock);
        $password = 'weakpassword';
        $username = 'test';

        ob_start();
        $accesUtilisateur->inscription($username, $password, $password);
        $output = ob_get_clean();

        $this->assertStringContainsString('Le mot de passe doit comporter au moins une majuscule', $output);
        $this->assertStringContainsString('Le mot de passe doit comporter au moins un chiffre', $output);
        $this->assertStringContainsString('Le mot de passe doit comporter au moins un caract', $output);
    }

    public function testInscriptionWithDifferentPasswords()
    {
        $accesUtilisateur = new AccesUtilisateur($this->accesDonneesMock);
        $password = 'testPassword1#';
        $username = 'test';

        ob_start();
        $accesUtilisateur->inscription($username, $password, 'differentPassword');
        $output = ob_get_clean();
        
        $this->assertStringContainsString('Les mots de passe ne correspondent pas', $output);
}

/*public function testInscriptionWithInvalidUsername()
{
    
    $accesUtilisateur = new AccesUtilisateur($this->accesDonneesMock);
    $password = 'testPassword1#';
    $username = '';

    ob_start();
    $accesUtilisateur->inscription($username, $password, $password);
    $output = ob_get_clean();

    $this->assertStringContainsString('Nom d\'utilisateur invalide', $output);
}*/

public function testInscriptionWithInvalidPassword()
{
    $accesUtilisateur = new AccesUtilisateur($this->accesDonneesMock);
    $password = 'password'; // 8 caractères mais pas de majuscule, chiffre ou caractère spécial
    $username = 'test';

    ob_start();
    $accesUtilisateur->inscription($username, $password, $password);
    $output = ob_get_clean();

    $this->assertStringContainsString('Le mot de passe doit comporter au moins une majuscule', $output);
    $this->assertStringContainsString('Le mot de passe doit comporter au moins un chiffre', $output);
    $this->assertStringContainsString('Le mot de passe doit comporter au moins un caractère spécial', $output);
}


/*
public function testInscriptionWithValidCredentials()
{
    $accesUtilisateur = new AccesUtilisateur($this->accesDonneesMock);
    $password = 'testPassword1#';
    $username = 'test';

    ob_start();
    $accesUtilisateur->inscription($username, $password, $password);
    $output = ob_get_clean();

    $this->assertStringContainsString('Vous avez été inscrit avec succès', $output);
}*/


}