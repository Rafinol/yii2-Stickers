<?php
namespace core\Repo;

use core\entities\Orders;
use core\entities\Statuses;
use core\entities\Users;

class OrderRepo
{
    private $user;
    private $description;

    public function __construct(Users $user, $description)
    {
        $this->user = $user;
        $this->description = $description;
    }

    public function create()
    {
        $order = new Orders();
        $order->status_id = Statuses::STATUS_NEW;
        $order->description = $this->description;
        $order->save();
    }


}