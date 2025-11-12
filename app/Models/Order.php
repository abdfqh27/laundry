<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Tambahkan constants untuk status order
    const STATUS_PENDING = 'pending';
    const STATUS_PROCESSING = 'processing';
    const STATUS_COMPLETED = 'completed';
    const STATUS_PICKED_UP = 'picked_up';
    const STATUS_CANCELLED = 'cancelled';

    // Constants untuk payment status
    const PAYMENT_UNPAID = 'unpaid';
    const PAYMENT_PAID = 'paid';
    const PAYMENT_REFUNDED = 'refunded';

    protected $fillable = [
        'customer_id',
        'order_number',
        'notes',
        'pickup_date',
        'delivery_date',
        'total_amount',
        'status',
        'payment_status',
        'karyawan_id',
        'completed_at',
    ];

    protected $casts = [
        'pickup_date' => 'datetime',
        'completed_at' => 'datetime',
        'total_amount' => 'decimal:2',
    ];

    /**
     * Get all available statuses with labels
     */
    public static function getStatuses()
    {
        return [
            self::STATUS_PENDING => 'Pending',
            self::STATUS_PROCESSING => 'Processing',
            self::STATUS_COMPLETED => 'Completed',
            self::STATUS_PICKED_UP => 'Picked Up',
            self::STATUS_CANCELLED => 'Cancelled',
        ];
    }

    /**
     * Get all available payment statuses with labels
     */
    public static function getPaymentStatuses()
    {
        return [
            self::PAYMENT_UNPAID => 'Unpaid',
            self::PAYMENT_PAID => 'Paid',
            self::PAYMENT_REFUNDED => 'Refunded',
        ];
    }

    /**
     * Relasi ke Customer (User)
     */
    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    /**
     * Relasi ke Karyawan (User)
     */
    public function karyawan()
    {
        return $this->belongsTo(User::class, 'karyawan_id');
    }

    /**
     * Relasi ke Order Items (One to Many)
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Relasi ke Transactions (One to Many)
     * Diubah dari hasOne ke hasMany karena di controller menggunakan transactions()
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * Relasi ke Transaction (One to One) - untuk transaksi utama
     */
    public function transaction()
    {
        return $this->hasOne(Transaction::class)->latestOfMany();
    }

    /**
     * Scope untuk filter berdasarkan status
     */
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope untuk filter berdasarkan payment status
     */
    public function scopePaymentStatus($query, $paymentStatus)
    {
        return $query->where('payment_status', $paymentStatus);
    }

    /**
     * Get status badge color
     */
    public function getStatusBadgeColorAttribute()
    {
        return match($this->status) {
            self::STATUS_PENDING => 'warning',
            self::STATUS_PROCESSING => 'info',
            self::STATUS_COMPLETED => 'success',
            self::STATUS_PICKED_UP => 'primary',
            self::STATUS_CANCELLED => 'danger',
            default => 'secondary',
        };
    }

    /**
     * Get payment status badge color
     */
    public function getPaymentStatusBadgeColorAttribute()
    {
        return match($this->payment_status) {
            self::PAYMENT_PAID => 'success',
            self::PAYMENT_UNPAID => 'warning',
            self::PAYMENT_REFUNDED => 'info',
            default => 'secondary',
        };
    }

    /**
     * Get status label
     */
    public function getStatusLabelAttribute()
    {
        $statuses = self::getStatuses();
        return $statuses[$this->status] ?? ucfirst($this->status);
    }

    /**
     * Get payment status label
     */
    public function getPaymentStatusLabelAttribute()
    {
        $statuses = self::getPaymentStatuses();
        return $statuses[$this->payment_status] ?? ucfirst($this->payment_status);
    }
}