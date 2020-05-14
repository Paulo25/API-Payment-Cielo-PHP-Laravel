<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Cielo\API30\Merchant;

use Cielo\API30\Ecommerce\Environment;
use Cielo\API30\Ecommerce\Sale;
use Cielo\API30\Ecommerce\CieloEcommerce;
use Cielo\API30\Ecommerce\Payment;
use Cielo\API30\Ecommerce\CreditCard;



trait CieloCreditCardTrait
{


    private $environment;
    private $merchant;
    private $cielo;
    private $sale;
    private $payment;

    public function __construct(Request $request)
    {
        // Configure o ambiente
        $this->environment = Environment::sandbox();
        // Configure seu merchant
        $this->merchant = new Merchant(config('cielo.MerchantId'), config('cielo.MerchantKey'));
        //Crie uma instância de CieloEcommerce escolhendo o ambiente onde os pedidos serão enviados
        $this->cielo = new CieloEcommerce($this->merchant, $this->environment);
        // Crie uma instância de Sale informando o ID do pedido na loja
        $this->sale = new Sale('123');
        //Forma de pagamento
        $this->payment = Payment::PAYMENTTYPE_CREDITCARD;
    }


    public function creditCard($request)
    {

        // Crie uma instância de Customer informando o nome do cliente
        $this->sale->customer($request->holder);

        // Crie uma instância de Payment informando o valor do pagamento
        $this->paymentInit($request->price);

        // Crie uma instância de Credit Card utilizando os dados de teste
        // esses dados estão disponíveis no manual de integração
        $this->cardData($request->price, $request->cvv, $request->date, $request->numberCard, $request->holder);

    }

    private function createSale()
    {
        return ($this->cielo)->createSale($this->sale);
    }

    private function captureSale($price)
    {
        return ($this->cielo)->captureSale($this->paymentId(), $price, 0);
    }

    private function cancelSale($price)
    {
        return ($this->cielo)->cancelSale($this->paymentId(), $price);
    }

    private function paymentInit($price)
    {
        return $this->sale->payment($price);
    }

    private function paymentId()
    {
        return $this->createSale()->getPayment()->getPaymentId();
    }

    private function cardData($price, $cvv, $date, $numberCard, $holder)
    {
        $this->paymentInit($price)->setType($this->payment)
            ->creditCard($cvv, CreditCard::VISA)
            ->setExpirationDate($date)
            ->setCardNumber($numberCard)
            ->setHolder($holder);
    }


}
