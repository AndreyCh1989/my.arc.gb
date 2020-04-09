<?php


namespace Service\Order;


use Service\Billing\BillingInterface;
use Service\Communication\CommunicationInterface;
use Service\Discount\DiscountInterface;
use Service\User\SecurityInterface;

class CheckoutManager
{
    /**
     * @var array
     */
    private $products;

    /**
     * @var DiscountInterface
     */
    private $discount;

    /**
     * @var BillingInterface
     */
    private $billing;

    /**
     * @var SecurityInterface
     */
    private $security;

    /**
     * @var CommunicationInterface
     */
    private $communication;

    function __construct(
        array $products,
        DiscountInterface $discount,
        BillingInterface $billing,
        SecurityInterface $security,
        CommunicationInterface $communication
    )
    {
        $this->products = $products;
        $this->discount = $discount;
        $this->billing = $billing;
        $this->security = $security;
        $this->communication = $communication;
    }

    public function checkout() {
        $totalPrice = 0;
        foreach ($this->products as $product) {
            $totalPrice += $product->getPrice();
        }

        $discount = $this->discount->getDiscount();
        $totalPrice = $totalPrice - $totalPrice / 100 * $discount;

        $this->billing->pay($totalPrice);

        $user = $this->security->getUser();
        $this->communication->process($user, 'checkout_template');
    }
}