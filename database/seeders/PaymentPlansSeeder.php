<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentPlansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $paymentPlans = [
            [
                'name' => 'One-off Outright Payment',
                'code' => 'outright',
                'description' => 'Full payment made immediately with no additional charges.',
                'duration_months' => 0,
                'interest_rate' => 0.00,
                'installments_count' => 1,
                'down_payment_percentage' => 100.00,
                'is_active' => true,
                'terms_conditions' => json_encode([
                    'All estate prices are all-inclusive – no hidden charges or extra fees.',
                    'Payment must be completed within 30 days of subscription.',
                    'No interest or additional charges apply.'
                ]),
                'grace_period_days' => 30,
                'late_fee_percentage' => 5.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '3 Months Outright',
                'code' => '3_months',
                'description' => 'Payment to be completed within 3 months with no additional charges.',
                'duration_months' => 3,
                'interest_rate' => 0.00,
                'installments_count' => 1,
                'down_payment_percentage' => 0.00,
                'is_active' => true,
                'terms_conditions' => json_encode([
                    'Payment must be completed within 3 months of subscription.',
                    'Any default after 3 months attracts a 5% penalty.',
                    'No interest charges apply within the 3-month period.'
                ]),
                'grace_period_days' => 7,
                'late_fee_percentage' => 5.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '6 Months Installment (10% Extra)',
                'code' => '6_months',
                'description' => '6-month installment plan with 10% additional charge on total price.',
                'duration_months' => 6,
                'interest_rate' => 10.00,
                'installments_count' => 6,
                'down_payment_percentage' => 20.00,
                'is_active' => true,
                'terms_conditions' => json_encode([
                    '6-month installment attracts an additional 10% on the total price.',
                    'Monthly installments must be paid by the due date.',
                    'Late payments attract additional penalties.',
                    '20% down payment required at subscription.'
                ]),
                'grace_period_days' => 7,
                'late_fee_percentage' => 5.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '1 Year Installment (20% Extra)',
                'code' => '12_months',
                'description' => '12-month installment plan with 20% additional charge on total price.',
                'duration_months' => 12,
                'interest_rate' => 20.00,
                'installments_count' => 12,
                'down_payment_percentage' => 15.00,
                'is_active' => true,
                'terms_conditions' => json_encode([
                    '12-month (1-year) installment attracts an additional 20% on the total price.',
                    'Monthly installments must be paid by the due date.',
                    'Late payments attract additional penalties.',
                    '15% down payment required at subscription.'
                ]),
                'grace_period_days' => 7,
                'late_fee_percentage' => 5.00,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        DB::table('payment_plans')->insert($paymentPlans);
    }
}
