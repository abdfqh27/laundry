{{-- resources/views/transaction/show-styles.blade.php --}}

<style>
    /* ============================================
       CURRENT ORDER STATUS BOX - PROMINENT
       ============================================ */
    .current-order-status-box {
        background: linear-gradient(135deg, rgba(16, 185, 129, 0.08) 0%, rgba(16, 185, 129, 0.02) 100%);
        border: 2px solid rgba(16, 185, 129, 0.2);
        border-radius: 16px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .status-box-label {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: rgba(255, 255, 255, 0.7);
        font-size: 0.85rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 1rem;
    }

    .status-box-label i {
        color: #10b981;
        font-size: 1rem;
    }

    .status-display-large {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 1rem;
        padding: 1.25rem 2rem;
        border-radius: 12px;
        font-size: 1.5rem;
        font-weight: 800;
        letter-spacing: 1px;
        text-transform: uppercase;
        position: relative;
        overflow: hidden;
    }

    .status-display-large::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 4px;
        animation: statusPulse 2s infinite;
    }

    @keyframes statusPulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.5; }
    }

    .status-display-large i {
        font-size: 2rem;
        animation: statusIconBounce 2s infinite;
    }

    @keyframes statusIconBounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-5px); }
    }

    .status-display-large.secondary {
        background: linear-gradient(135deg, rgba(107, 114, 128, 0.2) 0%, rgba(107, 114, 128, 0.05) 100%);
        border: 2px solid rgba(107, 114, 128, 0.4);
        color: #9ca3af;
    }
    .status-display-large.secondary::before { background: #9ca3af; }

    .status-display-large.warning {
        background: linear-gradient(135deg, rgba(245, 158, 11, 0.2) 0%, rgba(245, 158, 11, 0.05) 100%);
        border: 2px solid rgba(245, 158, 11, 0.4);
        color: #f59e0b;
    }
    .status-display-large.warning::before { background: #f59e0b; }

    .status-display-large.success {
        background: linear-gradient(135deg, rgba(16, 185, 129, 0.2) 0%, rgba(16, 185, 129, 0.05) 100%);
        border: 2px solid rgba(16, 185, 129, 0.4);
        color: #10b981;
    }
    .status-display-large.success::before { background: #10b981; }

    .status-display-large.info {
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.2) 0%, rgba(59, 130, 246, 0.05) 100%);
        border: 2px solid rgba(59, 130, 246, 0.4);
        color: #3b82f6;
    }
    .status-display-large.info::before { background: #3b82f6; }

    .status-display-large.danger {
        background: linear-gradient(135deg, rgba(239, 68, 68, 0.2) 0%, rgba(239, 68, 68, 0.05) 100%);
        border: 2px solid rgba(239, 68, 68, 0.4);
        color: #ef4444;
    }
    .status-display-large.danger::before { background: #ef4444; }

    /* ============================================
       ORDER ACTION BUTTONS
       ============================================ */
    .order-action-buttons {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
        margin-top: 1.5rem;
    }

    .update-order-btn.primary-action {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        border: none;
        box-shadow: 0 6px 20px rgba(59, 130, 246, 0.4);
        animation: btnPulse 2s infinite;
    }

    @keyframes btnPulse {
        0%, 100% { transform: scale(1); box-shadow: 0 6px 20px rgba(59, 130, 246, 0.4); }
        50% { transform: scale(1.02); box-shadow: 0 8px 30px rgba(59, 130, 246, 0.5); }
    }

    .update-order-btn.primary-action:hover {
        animation: none;
        transform: translateY(-3px);
        box-shadow: 0 10px 35px rgba(59, 130, 246, 0.6);
    }

    /* ============================================
       PHONE & EMAIL LINKS
       ============================================ */
    .phone-link, .email-link {
        color: #10b981;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .phone-link:hover, .email-link:hover {
        color: #059669;
        text-decoration: underline;
    }

    /* ============================================
       ORDER NOTES TIMELINE
       ============================================ */
    .order-notes-timeline {
        position: relative;
        padding-left: 2rem;
    }

    .order-notes-timeline::before {
        content: '';
        position: absolute;
        left: 0.5rem;
        top: 0;
        bottom: 0;
        width: 2px;
        background: linear-gradient(to bottom, #10b981, rgba(16, 185, 129, 0.3));
    }

    .timeline-item {
        position: relative;
        margin-bottom: 1.5rem;
        padding-left: 1.5rem;
    }

    .timeline-item:last-child {
        margin-bottom: 0;
    }

    .timeline-marker {
        position: absolute;
        left: -1.25rem;
        top: 0.25rem;
        width: 12px;
        height: 12px;
        background: #10b981;
        border-radius: 50%;
        border: 3px solid rgba(17, 24, 39, 0.9);
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.3);
    }

    .timeline-content {
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 10px;
        padding: 1rem;
        color: rgba(255, 255, 255, 0.9);
        font-size: 0.9rem;
        line-height: 1.6;
        white-space: pre-wrap;
    }

    /* ============================================
       STATUS SELECTION GRID (MODAL)
       ============================================ */
    .status-selection-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        margin-top: 1rem;
    }

    .status-radio-card {
        position: relative;
        cursor: pointer;
    }

    .status-radio-card input[type="radio"] {
        position: absolute;
        opacity: 0;
        pointer-events: none;
    }

    .radio-card-content {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem 1.25rem;
        background: rgba(255, 255, 255, 0.03);
        border: 2px solid rgba(255, 255, 255, 0.1);
        border-radius: 12px;
        transition: all 0.3s ease;
        position: relative;
    }

    .status-radio-card:hover .radio-card-content {
        background: rgba(255, 255, 255, 0.05);
        transform: translateY(-2px);
    }

    .status-radio-card input[type="radio"]:checked + .radio-card-content {
        border-width: 3px;
    }

    .radio-card-content.secondary {
        border-color: rgba(107, 114, 128, 0.3);
    }
    .status-radio-card input[type="radio"]:checked + .radio-card-content.secondary {
        border-color: #9ca3af;
        background: rgba(107, 114, 128, 0.1);
        box-shadow: 0 0 0 3px rgba(107, 114, 128, 0.2);
    }

    .radio-card-content.warning {
        border-color: rgba(245, 158, 11, 0.3);
    }
    .status-radio-card input[type="radio"]:checked + .radio-card-content.warning {
        border-color: #f59e0b;
        background: rgba(245, 158, 11, 0.1);
        box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.2);
    }

    .radio-card-content.success {
        border-color: rgba(16, 185, 129, 0.3);
    }
    .status-radio-card input[type="radio"]:checked + .radio-card-content.success {
        border-color: #10b981;
        background: rgba(16, 185, 129, 0.1);
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.2);
    }

    .radio-card-content.info {
        border-color: rgba(59, 130, 246, 0.3);
    }
    .status-radio-card input[type="radio"]:checked + .radio-card-content.info {
        border-color: #3b82f6;
        background: rgba(59, 130, 246, 0.1);
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
    }

    .radio-card-content.danger {
        border-color: rgba(239, 68, 68, 0.3);
    }
    .status-radio-card input[type="radio"]:checked + .radio-card-content.danger {
        border-color: #ef4444;
        background: rgba(239, 68, 68, 0.1);
        box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.2);
    }

    .radio-card-content > i {
        font-size: 2rem;
        flex-shrink: 0;
    }

    .radio-card-content.secondary > i { color: #9ca3af; }
    .radio-card-content.warning > i { color: #f59e0b; }
    .radio-card-content.success > i { color: #10b981; }
    .radio-card-content.info > i { color: #3b82f6; }
    .radio-card-content.danger > i { color: #ef4444; }

    .radio-card-text {
        flex: 1;
    }

    .radio-card-text strong {
        display: block;
        color: white;
        font-size: 1rem;
        margin-bottom: 0.25rem;
    }

    .radio-card-text small {
        display: block;
        color: rgba(255, 255, 255, 0.6);
        font-size: 0.8rem;
    }

    .current-badge {
        position: absolute;
        top: -0.5rem;
        right: -0.5rem;
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
        font-size: 0.7rem;
        font-weight: 700;
        padding: 0.25rem 0.6rem;
        border-radius: 6px;
        letter-spacing: 0.5px;
        box-shadow: 0 4px 10px rgba(16, 185, 129, 0.4);
    }

    .status-radio-card.current .radio-card-content {
        border-color: #10b981;
        background: rgba(16, 185, 129, 0.1);
    }

    /* ============================================
       MODAL SIZE ADJUSTMENTS
       ============================================ */
    .modal-lg {
        max-width: 900px;
    }

    .modal-xl {
        max-width: 1200px;
    }

    /* ============================================
       RESPONSIVE DESIGN
       ============================================ */
    @media (max-width: 992px) {
        .status-selection-grid {
            grid-template-columns: 1fr;
        }

        .status-display-large {
            font-size: 1.25rem;
        }

        .status-display-large i {
            font-size: 1.75rem;
        }
    }

    @media (max-width: 768px) {
        .current-order-status-box {
            padding: 1rem;
        }

        .status-display-large {
            padding: 1rem 1.5rem;
            font-size: 1.1rem;
        }

        .radio-card-content {
            flex-direction: column;
            text-align: center;
        }

        .order-notes-timeline {
            padding-left: 1.5rem;
        }

        .timeline-item {
            padding-left: 1rem;
        }
    }

    @media (max-width: 576px) {
        .order-action-buttons {
            gap: 0.5rem;
        }

        .update-order-btn span,
        .view-order-btn span {
            font-size: 0.9rem;
        }

        .modal-dialog {
            margin: 1rem;
        }
    }

    /* ============================================
       PRINT STYLES (OPTIONAL)
       ============================================ */
    @media print {
        .back-button,
        .action-card,
        .order-action-buttons,
        .danger-zone,
        .modal {
            display: none !important;
        }

        .detail-card {
            break-inside: avoid;
            page-break-inside: avoid;
        }

        .status-badge-xl,
        .status-display-large {
            border: 2px solid #000 !important;
        }
    }
</style>