<?php

namespace App\Http\Requests;

use App\Models\AccountPermission;
use App\Services\AccountHolderService;
use Illuminate\Foundation\Http\FormRequest;

class StoreTransactionRequest extends FormRequest
{
    public function __construct(AccountHolderService $accountHolderService)
    {
        $this->accountHolderService = $accountHolderService;
    }
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $this->getValidatorInstance()->validate();
        if (!$this->accountHolderService->can($this->payer_id, AccountPermission::TRANSFER_ACTION)) {
            abort(403, 'Payer not authorized to make transfers');
        }
        if (!$this->accountHolderService->can($this->payer_id, AccountPermission::RECEIVE_ACTION)) {
            abort(403, 'Payee not authorized to receive transfers');
        }
        if (!$this->accountHolderService->hasBalance($this->payer_id, $this->value)) {
            abort(403, 'Payer does not have enough balance');
        }
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'value' => [
                'required',
                'numeric',
                'gt:0'
            ],
            'payer_id' => [
                'required',
                'exists:App\Models\AccountHolder,id',
                'different:payee_id'
            ],
            'payee_id' => [
                'required',
                'exists:App\Models\AccountHolder,id',
                'different:payer_id'
            ]
        ];
    }
}
