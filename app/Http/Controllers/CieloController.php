<?php

namespace App\Http\Controllers;


use App\Traits\CieloCreditCardTrait;
use Illuminate\Http\Request;
use Cielo\API30\Ecommerce\Request\CieloRequestException;


class CieloController extends Controller
{

    use CieloCreditCardTrait;

    /**
     * Função responsável por retornar view de pagamento com cartão de crédito
     */
    public function viewCreditCard(){
        return view('payment.creditCard');
    }

    /**
     * Função responsável por retornar view de pagamento com boleto
     */
    public function viewPaymentSlip(){
        return view('payment.paymentSlip');
    }

    /**
     * Função responsável por fazer transação com api cielo credit card
     */
    public function peyerCreditCard(Request $request){
        $this->creditCard($request);

        /**Crie o pagamento na Cielo*/
        try {
            // Configure o SDK com seu merchant e o ambiente apropriado para criar a venda
            $this->createSale();

            $total = $request->price;
            // Com o ID do pagamento, podemos fazer sua captura, se ela não tiver sido capturada ainda
            $captura = $this->captureSale($request->price);
            //dd($captura );

            return view('payment.success', compact('total'));
        } catch (CieloRequestException $e) {
            // Em caso de erros de integração, podemos tratar o erro aqui.
            // os códigos de erro estão todos disponíveis no manual de integração.
            $error = $e->getCieloError();
            return view('payment.error', compact('error'));
        }
    }

}
