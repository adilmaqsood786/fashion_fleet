<?php

namespace App\Http\Requests;

use App\Models\Order;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class UpdateOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, array<int, string|Rule>>
     */
    public function rules(): array
    {
        /** @var Order $order */
        $order = $this->route('order');

        return [
            'user_id' => ['required', 'exists:users,id'],
            'vendor_id' => ['required', 'exists:vendors,id'],
            'rider_id' => ['nullable', 'exists:riders,id'],
            'profile_id' => ['required', 'exists:user_profiles,id'],
            'order_number' => ['required', 'string', 'max:255', Rule::unique('orders', 'order_number')->ignore($order)],
            'delivery_fee' => ['nullable', 'numeric', 'min:0'],
            'discount' => ['nullable', 'numeric', 'min:0'],
            'tax' => ['nullable', 'numeric', 'min:0'],
            'payment_status' => ['required', 'string', 'max:255'],
            'order_status' => ['required', 'string', 'max:255'],
            'notes' => ['nullable', 'string'],
            'placed_at' => ['nullable', 'date'],
            'delivered_at' => ['nullable', 'date', 'after_or_equal:placed_at'],
            'product_id' => ['required', 'array', 'min:1'],
            'product_id.*' => ['required', 'distinct', 'exists:products,id'],
            'quantity' => ['required', 'array', 'min:1'],
            'quantity.*' => ['required', 'integer', 'min:1'],
        ];
    }

    /**
     * Validate relationships that depend on more than one request field.
     *
     * @return array<int, callable>
     */
    public function after(): array
    {
        return [function (Validator $validator): void {
            $productIds = $this->input('product_id', []);
            $quantities = $this->input('quantity', []);

            if (count($productIds) !== count($quantities)) {
                $validator->errors()->add('quantity', 'Each product must have a quantity.');
            }

            if (! $this->filled('vendor_id') || $validator->errors()->isNotEmpty()) {
                return;
            }

            $productCount = DB::table('products')
                ->where('vendor_id', $this->integer('vendor_id'))
                ->whereIn('id', $productIds)
                ->count();

            if ($productCount !== count($productIds)) {
                $validator->errors()->add('product_id', 'Every product must belong to the selected vendor.');
            }
        }];
    }
}
