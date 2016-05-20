<?php
    class CartTester extends PHPUnit_Framework_Testcase {
        public function setUp() {
            @session_start();
            parent::setUp();
        }
        public function testGetCartWithoutLogin() {
            $this->assertEquals(null, Cart::getcart());
        }
        public function testGetCartBlank() {
            Account::login("user2", "user2");
            $this->assertEquals(array(), Cart::getcart());
            Account::logout();
        }
        public function testAddWithoutLogin() {
            $this->assertEquals(0, Cart::addtocart(1));
        }
        public function testAddOneTicket() {
            Account::login("user2", "user2");
            $this->assertEquals(1, Cart::addtocart(1));
            $expected = array(array('item'=>Ticket::getTicketInfo(1), 'qty'=>1));
            $result = Cart::getcart();
            $this->assertEquals($expected, $result);
            Account::logout();
        }
        public function testAddDuplicatedTicket() {
            Account::login("user2", "user2");
            $this->assertEquals(1, Cart::addtocart(1));
            $this->assertEquals(1, Cart::addtocart(1));
            $expected = array(array('item'=>Ticket::getTicketInfo(1), 'qty'=>2));
            $result = Cart::getcart();
            $this->assertEquals($expected, $result);
            Account::logout();
        }
        public function testAddDifferentTicket() {
            Account::login("user2", "user2");
            $this->assertEquals(1, Cart::addtocart(1));
            $this->assertEquals(1, Cart::addtocart(2));
            $expected = array(array('item'=>Ticket::getTicketInfo(1), 'qty'=>1), array('item'=>Ticket::getTicketInfo(2), 'qty'=>1));
            $result = Cart::getcart();
            $this->assertEquals($expected, $result);
            Account::logout();
        }
        public function testRemoveWithoutLogin() {
            $this->assertEquals(0, Cart::removefromcart(1));
        }
        public function testRemoveOneTicket() {
            Account::login("user2", "user2");
            $this->assertEquals(1, Cart::addtocart(1));
            $this->assertEquals(1, Cart::addtocart(1));
            $this->assertEquals(1, Cart::removefromcart(1));
            $expected = array(array('item'=>Ticket::getTicketInfo(1), 'qty'=>1));
            $result = Cart::getcart();
            $this->assertEquals($expected, $result);
            Account::logout();
        }
        public function testRemoveAllTicket() {
            Account::login("user2", "user2");
            $this->assertEquals(1, Cart::addtocart(1));
            $this->assertEquals(1, Cart::removefromcart(1));
            $expected = array();
            $result = Cart::getcart();
            $this->assertEquals($expected, $result);
            Account::logout();
        }
        public function testRemoveTicketNotInCart() {
            Account::login("user2", "user2");
            $this->assertEquals(1, Cart::removefromcart(1));
            $expected = array();
            $result = Cart::getcart();
            $this->assertEquals($expected, $result);
            Account::logout();
        }
        public function testTotalFareWithoutLogin() {
            $this->assertEquals(0, Cart::gettotalfare());
        }
        public function testTotalFareOneTicket() {
            Account::login("user2", "user2");
            $this->assertEquals(1, Cart::addtocart(1));
            $ticket1 = Ticket::getTicketInfo(1);
            $expected = $ticket1['Fare'] * 1;
            $result = Cart::gettotalfare();
            $this->assertEquals($expected, $result);
            Account::logout();
        }
        public function testTotalFareDuplicatedTicket() {
            Account::login("user2", "user2");
            $this->assertEquals(1, Cart::addtocart(1));
            $this->assertEquals(1, Cart::addtocart(1));
            $ticket1 = Ticket::getTicketInfo(1);
            $expected = $ticket1['Fare'] * 2;
            $result = Cart::gettotalfare();
            $this->assertEquals($expected, $result);
            Account::logout();
        }
        public function testTotalFareDiferrentTicket() {
            Account::login("user2", "user2");
            $this->assertEquals(1, Cart::addtocart(1));
            $this->assertEquals(1, Cart::addtocart(2));
            $ticket1 = Ticket::getTicketInfo(1);
            $ticket2 = Ticket::getTicketInfo(2);
            $expected = $ticket1['Fare'] * 1 + $ticket2['Fare'] * 1;
            $result = Cart::gettotalfare();
            $this->assertEquals($expected, $result);
            Account::logout();
        }
        public function testTotalFareNoTicket() {
            Account::login("user2", "user2");
            $expected = 0;
            $result = Cart::gettotalfare();
            $this->assertEquals($expected, $result);
            Account::logout();
        }
    }
?>
