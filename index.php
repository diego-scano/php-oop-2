<?php

// OGGETTO IN VENDITA
class Item
{
    protected $id;

    protected $image;

    protected $name;

    protected $category;

    protected $price;

    public function __construct(int $id, string $image, string $name, string $category, float $price) {
        $this->id = $id;
        $this->image = $image;
        $this->name = $name;
        $this->category = $category;
        $this->price = $price;
    }
}

// UTENTE NORMALE
class User
{
    protected $id;

    protected $name;

    protected $surname;

    protected $username;

    private $password;

    protected $address;

    protected $email;

    protected $dateOfBirth;

    protected $maxDeliveryDays = 6;

    public function __construct(int $id, string $name, string $surname, string $username, string $password, string $address, string $email, string $dateOfBirth) {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->username = $username;
        $this->password = $password;
        $this->address = $address;
        $this->email = $email;
        $this->dateOfBirth = $dateOfBirth;
    }

    public function addCreditCard($creditCard) {
        if($creditCard->getMoney() > 0) {
            $this->creditCards = $creditCard;
        } else {
            throw new Exception('Poor customer.');
        }
    }
}

// UTENTE VIP
class VipUser extends User 
{
    protected $maxDeliveryDays = 2;
}

class CreditCard 
{
    private $number;

    private $money;

    public function __construct(string $number, float $money) {
        $this->number = $number;
        $this->money = $money;     
    }

    public function getMoney() {
        return $this->money;
    }
}

// CLIENTE 1
$newCustomer = new User(1, 'Pinco', 'Pallo', 'pinco.pallo', 'estate98', 'via Rossi 5', 'pinco@pallo.it', '01/01/1990');
// CARTA DI CREDITO 1
$newCreditCard = new CreditCard('123456', 100.00);
$newCustomer->addCreditCard($newCreditCard);

// CLIENTE 2 (VIP)
$newVipCustomer = new VipUser(2, 'Gianni', 'Pidoro', 'gianni.pidoro', 'inverno75', 'via Bianchi 7', 'gianni@pidoro.com', '23/04/1965');
// CARTA DI CREDITO 2
$otherCreditCard = new CreditCard('759257', 200.00);
$newVipCustomer->addCreditCard($otherCreditCard);

// ARTICOLO 1
$newItem = new Item(1, 'https://images-na.ssl-images-amazon.com/images/I/81DxcHJ9r2L._AC_SL1500_.jpg', 'Scheda Audio', 'Musica', '180.00');

// CLIENTE 3
$anotherCustomer = new User(3, 'Gino', 'Lollo', 'gino.lollo', 'autunno80', 'via Verdi 11', 'gino@lollo.org', '14/03/1997');
// CARTA DI CREDITO 3 (VUOTA)
$anotherCreditCard = new CreditCard('963485', 0.00);

var_dump($newItem);
var_dump($newCustomer);
var_dump($newVipCustomer);
var_dump($anotherCustomer);

// PROVA DI ERRORE (PER CARTA DI CREDITO ESAURITA)
try {
    $anotherCustomer->addCreditCard($anotherCreditCard);
} catch (Exception $e) {
    echo "SEI POVERO!";
}
