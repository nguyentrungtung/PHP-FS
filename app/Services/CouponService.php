<?php

namespace App\Services;

use App\Models\Coupon;
use App\Repositories\Contracts\RepositoryInterface\CouponRepositoryInterface;

class CouponService
{
    /**
     * @var CouponRepositoryInterface
     */
    private $couponRepositoryInterface;

    /**
     * @param CouponRepositoryInterface $couponRepositoryInterface
     */
    public function __construct(
        CouponRepositoryInterface $couponRepositoryInterface
    )
    {
        $this->couponRepositoryInterface = $couponRepositoryInterface;
    }

    public function getAllCouponsPaginate($limit)
    {
        return $this->couponRepositoryInterface->paginate($limit);
    }

    public function createCoupon(array $data)
    {
        return $this->couponRepositoryInterface->create($data);
    }

    public function getAllCoupons()
    {
        return $this->couponRepositoryInterface->all();
    }

    public function getCouponById($id)
    {
        return $this->couponRepositoryInterface->find($id);
    }

    // Hàm cập nhật thông tin coupon
    public function updateCoupon(int $id, array $data)
    {
        return $this->couponRepositoryInterface->update($id, $data);
    }

    // Hàm xóa coupon
    public function deleteCoupon(int $id)
    {
        return $this->couponRepositoryInterface->delete($id);
    }
}
