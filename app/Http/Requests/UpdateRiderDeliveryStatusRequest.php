<?php

namespace App\Http\Requests;

use App\Models\Order;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class UpdateRiderDeliveryStatusRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        /** @var Order|null $order */
        $order = $this->route('order');

        return $order !== null && $this->user()?->rider?->is($order->rider);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, array<int, string|Rule>>
     */
    public function rules(): array
    {
        return [
            'delivery_status' => ['required', Rule::in(['Picked Up', 'Out for Delivery', 'Delivered'])],
        ];
    }

    /**
     * Ensure riders progress delivery statuses in their intended order.
     *
     * @return array<int, callable>
     */
    public function after(): array
    {
        return [function (Validator $validator): void {
            /** @var Order $order */
            $order = $this->route('order');
            $nextStatuses = [
                'Assigned' => 'Picked Up',
                'Picked Up' => 'Out for Delivery',
                'Out for Delivery' => 'Delivered',
            ];

            if (($nextStatuses[$order->delivery_status] ?? null) !== $this->input('delivery_status')) {
                $validator->errors()->add('delivery_status', 'Select the next delivery status for this order.');
            }
        }];
    }
}
