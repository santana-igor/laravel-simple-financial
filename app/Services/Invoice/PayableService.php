<?php

namespace App\Services\Invoice;

use App\Abstracts\MasterClassInvoice;
use App\Helpers\NotificationService;
use App\Models\BankAccount;
use App\Models\Invoice;
use App\Models\Transaction;
use Illuminate\Support\Facades\Validator;

class PayableService extends MasterClassInvoice
{
    public function all()
    {
        // Composição da classe Notification para uso em qualquer parte desse método
            $notification = new NotificationService();

        $payables = Invoice::payables()->get();
        return $notification->create('success', [], 200, $payables);
    }

    public function store($data)
    {
        // Composição da classe Notification para uso em qualquer parte desse método
            $notification = new NotificationService();

        try {
            // Criando nova conta a pagar
                $this->model->checked = false;
                $this->model->type = 'payable';
                $this->model->nickname = $data['nickname'];
                $this->model->reference_number = $data['reference_number'];
                $this->model->amount = $data['amount'];
                $this->model->description = $data['description'];
                $this->model->customer_id = $data['customer_id'];
                $this->model->category_id = $data['category_id'];
                $this->model->issued_at = $data['issued_at'];
                $this->model->expired_at = $data['expired_at'];
                $this->model->save();

            return $notification->create('success', ['Cadastro efetuado com sucesso'], 200, $this->model);

        } catch (\Exception $e) {
            return $notification->create('error', [$e->getMessage()], 500);
        }
    }

    public function update(){}
    public function destroy(){}

    public function pay($data)
    {
        // Composição da classe Notification para uso em qualquer parte desse método
            $notification = new NotificationService();

        // Obter a conta bancária e a fatura que serão utilizadas na transação
            $bank_account = BankAccount::find($data['bank_account_id']);
            $invoice = Invoice::find($data['invoice_id']);

        // Armazenar em variável o resultado do saldo após debitar o valor da fatura
            $new_balance = $bank_account->balance - abs($data['amount']);

        // Validar se existe saldo disponível e efetuar o pagamento da fatura
            if ($new_balance > 0) {
                try {
                    // Criando nova transação
                        $transaction = new Transaction();
                        $transaction->amount = $data['amount'];
                        $transaction->invoice_id = $data['invoice_id'];
                        $transaction->bank_account_id = $data['bank_account_id'];
                        $transaction->traded_at = $data['traded_at'];
                        $transaction->save();

                    // Atualizando fatura para quitado
                        $invoice->checked = true;
                        $invoice->save();

                    // Atualizando saldo bancário
                        $bank_account->balance = $new_balance;
                        $bank_account->save();

                    return $notification->create('success', ['Pagamento efetuado com sucesso'], 200, $this->model);
                } catch (\Exception $e) {
                    return $notification->create('error', [$e->getMessage()], 500);
                }
            } else {
                return $notification->create('warning', ['Você não tem saldo suficiente para efetuar esse pagamento'], 400);
            }
    }
}
