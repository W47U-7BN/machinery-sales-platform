<?php

namespace App\Traits;

use App\Enums\ApprovalStatus;
use App\Models\Approval;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\Auth;

trait HasApprovals
{
    public static function bootHasApprovals(): void
    {
        static::deleting(function (Model $model) {
            $model->approvals()->delete();
        });
    }

    public function approvals(): MorphMany
    {
        return $this->morphMany(Approval::class, 'approvable');
    }

    public function pendingApproval(): MorphMany
    {
        return $this->approvals()->where('status', ApprovalStatus::Pending);
    }

    public function approvedBy(): MorphMany
    {
        return $this->approvals()->where('status', ApprovalStatus::Approved);
    }

    public function submitForApproval(?int $approverId = null, ?string $notes = null): Approval
    {
        return $this->approvals()->create([
            'approver_id' => $approverId,
            'status' => ApprovalStatus::Pending,
            'notes' => $notes,
            'submitted_by' => Auth::id(),
            'submitted_at' => now(),
        ]);
    }

    public function approve(int $approverId, ?string $notes = null): bool
    {
        $approval = $this->pendingApproval()->latest()->first();

        if (!$approval) {
            return false;
        }

        return $approval->update([
            'status' => ApprovalStatus::Approved,
            'approver_id' => $approverId,
            'notes' => $notes,
            'approved_at' => now(),
        ]);
    }

    public function reject(int $approverId, string $reason): bool
    {
        $approval = $this->pendingApproval()->latest()->first();

        if (!$approval) {
            return false;
        }

        return $approval->update([
            'status' => ApprovalStatus::Rejected,
            'approver_id' => $approverId,
            'notes' => $reason,
            'rejected_at' => now(),
        ]);
    }

    public function requestRevision(int $approverId, string $notes): bool
    {
        $approval = $this->pendingApproval()->latest()->first();

        if (!$approval) {
            return false;
        }

        return $approval->update([
            'status' => ApprovalStatus::NeedRevision,
            'approver_id' => $approverId,
            'notes' => $notes,
            'reviewed_at' => now(),
        ]);
    }

    public function isApproved(): bool
    {
        return $this->approvedBy()->exists();
    }

    public function isPendingApproval(): bool
    {
        return $this->pendingApproval()->exists();
    }

    public function getApprovalStatus(): ?ApprovalStatus
    {
        $latest = $this->approvals()->latest()->first();

        return $latest?->status;
    }
}
