<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard User</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* CSS khusus untuk dashboard - semua class dimulai dengan dash- */
        body {
            background-color: #ffffffff;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Arial, sans-serif;
            color: #2c3e50;
        }
        
        
    .breadcrumb-nav {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: #eff6ff;
      padding: 20px 40px;
      transition: var(--transition);
    }

    .breadcrumb-title {
      font-weight: 500;
      font-size: 24px;
      color: var(--text);
      padding-bottom: 0;
      position: relative;
      padding-left: 57px;
      transition: var(--transition);
    }

    .breadcrumb-title::after {
      display: none;
    }

    .breadcrumb-links {
      display: flex;
      align-items: center;
      font-size: 17px;
      padding-right: 45px;
      transition: var(--transition);
    }

    .breadcrumb-links a:first-child {
      color: var(--primary);
    }

    .breadcrumb-links a:last-child {
      color: var(--text);
    }

    .breadcrumb-links a {
      text-decoration: none;
      font-weight: 500;
      transition: var(--transition);
    }

    .breadcrumb-links a:hover {
      opacity: 0.8;
    }

    .breadcrumb-links span {
      margin: 0 8px;
      color: #94a3b8;
    }

        .dash-container {
            max-width: 1400px;
            margin: 20px auto;
            display: flex;
            padding: 0 20px;
            gap: 20px;
            align-items: flex-start;
        }
        
        .dash-sidebar {
            width: 280px;
            background-color: #ffffff;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.08);
            padding: 25px 0;
            display: flex;
            flex-direction: column;
            border-radius: 12px;
            flex-shrink: 0;
        }
        
        .dash-profile {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 30px;
            padding: 0 25px 25px;
            border-bottom: 1px solid #eeeeee;
        }
        
        .dash-avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: linear-gradient(135deg, #6a82fb 0%, #5b73e8 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 40px;
            margin-bottom: 15px;
            overflow: hidden;
        }
        
        .dash-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .dash-userinfo {
            text-align: center;
        }
        
        .dash-userinfo h3 {
            color: #2c3e50;
            margin-bottom: 5px;
            font-size: 20px;
        }
        
        .dash-userinfo p {
            color: #7f8c8d;
            font-size: 14px;
            margin: 0;
        }
        
        .dash-menu {
            list-style: none;
            padding: 15px 0;
            margin: 0;
        }
        
        .dash-menuitem {
            padding: 15px 25px;
            display: flex;
            align-items: center;
            cursor: pointer;
            transition: all 0.2s;
            color: #525f7f;
            font-weight: 500;
            position: relative;
            margin: 5px 10px;
            border-radius: 8px;
        }
        
        .dash-menuitem:hover {
            background-color: #f8f9fa;
            color: #5b73e8;
        }
        
        .dash-menuitem.dash-active {
            background-color: #5b73e8;
            color: white;
            font-weight: 600;
        }
        
        .dash-icon {
            margin-right: 15px;
            font-size: 18px;
            width: 24px;
            text-align: center;
        }
        
        .dash-content {
            flex: 1;
            border-radius: 12px;
        }
        
        .dash-card {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            padding: 30px;
            margin-bottom: 25px;
        }
        
        .dash-header {
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eeeeee;
        }
        
        .dash-header h2 {
            color: #2c3e50;
            font-size: 26px;
            margin-bottom: 10px;
            font-weight: 700;
        }
        
        .dash-header p {
            color: #7f8c8d;
            font-size: 16px;
        }
        
        /* Styling untuk My Orders */
        .dash-orderlist {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .dash-order {
            padding: 20px;
            border: 1px solid #e9ecef;
            border-radius: 10px;
            margin-bottom: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: transform 0.2s;
        }
        
        .dash-order:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }
        
        .dash-orderinfo h5 {
            color: #2c3e50;
            margin-bottom: 8px;
            font-size: 16px;
        }
        
        .dash-orderinfo p {
            color: #7f8c8d;
            font-size: 14px;
            margin: 3px 0;
        }
        
        .dash-status {
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
        }
        
        .dash-status-delivered {
            background-color: #e6f7ee;
            color: #00a76f;
        }
        
        .dash-status-processing {
            background-color: #fff7e6;
            color: #ff9500;
        }
        
        .dash-status-shipped {
            background-color: #e6f0ff;
            color: #3d7eff;
        }
        
   
    /* Gaya untuk Wishlist */
    .dash-wishgrid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 20px;
    }
    
    .dash-wishitem {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .dash-wishitem:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }
    
    .dash-wishimg {
        height: 160px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
    }
    
    .dash-wishdetails {
        padding: 20px;
    }
    
    .dash-wishdetails h5 {
        color: #1e293b;
        margin-bottom: 12px;
        font-size: 16px;
        font-weight: 600;
        line-height: 1.4;
    }
    
    .dash-wishprice {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 12px;
    }
    
    .dash-price {
        color: #4f46e5;
        font-weight: 700;
        font-size: 18px;
    }
    
    .dash-price-original {
        color: #94a3b8;
        text-decoration: line-through;
        font-size: 14px;
    }
    
    .dash-wishmeta {
        display: flex;
        flex-direction: column;
        gap: 6px;
        margin-bottom: 15px;
    }
    
    .dash-wishmeta span {
        display: flex;
        align-items: center;
        gap: 6px;
        color: #64748b;
        font-size: 14px;
    }
    
    .dash-wishmeta i {
        width: 16px;
        color: #4f46e5;
    }
    
    .dash-wishactions {
        display: flex;
        gap: 10px;
        align-items: center;
    }
    
    .dash-wishactions .dash-btn {
        flex: 1;
        padding: 10px 15px;
        font-size: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
    }
    
    .dash-wishremove {
        width: 40px;
        height: 40px;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        background: #f8fafc;
        color: #ef4444;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
    }
    
    .dash-wishremove:hover {
        background: #fef2f2;
        border-color: #ef4444;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .dash-wishgrid {
            grid-template-columns: 1fr;
        }
        
        .dash-wishactions {
            flex-direction: column;
        }
        
        .dash-wishremove {
            width: 100%;
            margin-top: 5px;
        }
    }

    /* Gaya untuk Promo & Voucher */
    .dash-promo-tabs {
        display: flex;
        border-bottom: 1px solid #e2e8f0;
        margin-bottom: 25px;
        flex-wrap: wrap;
    }
    
    .dash-tab-btn {
        padding: 12px 16px;
        background: none;
        border: none;
        font-weight: 500;
        color: #64748b;
        cursor: pointer;
        position: relative;
        transition: all 0.2s;
        font-size: 14px;
    }
    
    .dash-tab-btn:hover {
        color: #4f46e5;
    }
    
    .dash-tab-btn.dash-tab-active {
        color: #4f46e5;
        font-weight: 600;
    }
    
    .dash-tab-btn.dash-tab-active::after {
        content: '';
        position: absolute;
        bottom: -1px;
        left: 0;
        right: 0;
        height: 2px;
        background-color: #4f46e5;
    }
    
    .dash-promo-search {
        position: relative;
        margin-bottom: 25px;
        max-width: 400px;
    }
    
    .dash-promo-search i {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #64748b;
    }
    
    .dash-promo-search input {
        width: 100%;
        padding: 12px 15px 12px 45px;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        font-size: 15px;
        background-color: white;
    }
    
    .dash-promo-search input:focus {
        outline: none;
        border-color: #4f46e5;
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
    }
    
    .dash-promo-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 20px;
    }
    
    .dash-promo-card {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 20px;
        position: relative;
        transition: transform 0.2s, box-shadow 0.2s;
    }
    
    .dash-promo-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
    
    .dash-promo-badge {
        position: absolute;
        top: -8px;
        right: 15px;
        background: #ff4757;
        color: white;
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        z-index: 1;
    }
    
    .dash-promo-header {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
    }
    
    .dash-promo-icon {
        width: 50px;
        height: 50px;
        background: #f1f5f9;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
        color: #4f46e5;
        font-size: 20px;
    }
    
    .dash-promo-value h3 {
        margin: 0;
        color: #1e293b;
        font-size: 18px;
        font-weight: 700;
    }
    
    .dash-promo-value p {
        margin: 4px 0 0;
        color: #64748b;
        font-size: 14px;
    }
    
    .dash-promo-code {
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: #f8fafc;
        padding: 10px 15px;
        border-radius: 8px;
        margin-bottom: 15px;
    }
    
    .dash-promo-code span {
        font-weight: 600;
        color: #1e293b;
        letter-spacing: 1px;
        font-size: 15px;
    }
    
    .dash-promo-copy {
        background: none;
        border: none;
        color: #4f46e5;
        cursor: pointer;
        padding: 5px;
        border-radius: 4px;
        transition: background-color 0.2s;
    }
    
    .dash-promo-copy:hover {
        background-color: #eef2ff;
    }
    
    .dash-promo-detail {
        margin: 15px 0;
    }
    
    .dash-promo-detail p {
        display: flex;
        align-items: center;
        margin: 8px 0;
        color: #64748b;
        font-size: 14px;
    }
    
    .dash-promo-detail i {
        margin-right: 10px;
        width: 16px;
        color: #4f46e5;
    }
    
    .dash-promo-desc {
        color: #64748b;
        font-size: 14px;
        margin-bottom: 15px;
    }
    
    .dash-promo-price {
        margin: 15px 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .dash-price-old {
        text-decoration: line-through;
        color: #94a3b8;
        font-size: 14px;
    }
    
    .dash-price-new {
        color: #4f46e5;
        font-size: 18px;
        font-weight: 700;
    }
    
    .dash-promo-apply {
        width: 100%;
        margin-top: 10px;
    }
    
    /* Color Variants */
    .dash-promo-primary .dash-promo-icon {
        background: #eef2ff;
        color: #4f46e5;
    }
    
    .dash-promo-secondary .dash-promo-icon {
        background: #f0f9ff;
        color: #0ea5e9;
    }
    
    .dash-promo-success .dash-promo-icon {
        background: #f0fdf4;
        color: #22c55e;
    }
    
    .dash-promo-warning .dash-promo-icon {
        background: #fffbeb;
        color: #f59e0b;
    }
    
    .dash-promo-danger .dash-promo-icon {
        background: #fef2f2;
        color: #ef4444;
    }
    
    .dash-promo-info .dash-promo-icon {
        background: #eff6ff;
        color: #3b82f6;
    }
    
    /* Empty State */
    .dash-promo-empty {
        text-align: center;
        padding: 60px 20px;
    }
    
    .dash-empty-state i {
        font-size: 48px;
        color: #cbd5e1;
        margin-bottom: 15px;
    }
    
    .dash-empty-state h3 {
        color: #64748b;
        margin-bottom: 8px;
        font-weight: 600;
    }
    
    .dash-empty-state p {
        color: #94a3b8;
        margin: 0;
    }
    
    .dash-tab-content {
        display: block;
    }
    
    .dash-tab-content:not(#available-promos) {
        display: none;
    }
    
    .dash-empty-state i {
        font-size: 48px;
        color: #cbd5e1;
        margin-bottom: 15px;
    }
    
    .dash-empty-state h3 {
        color: #64748b;
        margin-bottom: 8px;
        font-weight: 600;
    }
    
    .dash-empty-state p {
        color: #94a3b8;
        margin: 0;
    }
    
    .dash-tab-content {
        display: block;
    }
    
    .dash-tab-content:not(#available-promos) {
        display: none;
    }
        
  

    /* Gaya untuk Ulasan */
    .dash-reviews-container {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }
    
    .dash-review {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 24px;
        transition: all 0.2s;
        position: relative;
    }
    
    .dash-review:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }
    
    .dash-review-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 16px;
        flex-wrap: wrap;
        gap: 15px;
    }
    
    .dash-review-info {
        flex: 1;
    }
    
    .dash-review-service {
        font-weight: 600;
        color: #1e293b;
        font-size: 18px;
        margin-bottom: 5px;
    }
    
    .dash-review-date {
        color: #64748b;
        font-size: 14px;
    }
    
    .dash-review-rating {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        gap: 5px;
    }
    
    .dash-review-stars {
        color: #ffc107;
        font-size: 16px;
    }
    
    .dash-rating-text {
        font-size: 14px;
        color: #64748b;
        font-weight: 500;
    }
    
    .dash-review-content {
        margin-bottom: 16px;
    }
    
    .dash-review-content p {
        color: #374151;
        line-height: 1.6;
        margin: 0;
    }
    
    .dash-review-meta {
        display: flex;
        gap: 20px;
        flex-wrap: wrap;
        margin-bottom: 16px;
    }
    
    .dash-review-meta span {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 14px;
        color: #64748b;
    }
    
    .dash-review-meta i {
        color: #4f46e5;
    }
    
    .dash-review-guide,
    .dash-review-duration,
    .dash-review-vehicle {
        padding: 6px 12px;
        background: #f8fafc;
        border-radius: 6px;
    }
    
    /* Tombol Aksi Ulasan */
    .dash-review-actions {
        display: flex;
        gap: 12px;
        justify-content: flex-end;
        padding-top: 16px;
        border-top: 1px solid #f1f5f9;
        margin-top: 16px;
    }
    
    .dash-btn-edit,
    .dash-btn-delete {
        padding: 8px 16px;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    
    .dash-btn-edit {
        background-color: #f8fafc;
        color: #4f46e5;
    }
    
    .dash-btn-edit:hover {
        background-color: #eef2ff;
        border-color: #4f46e5;
    }
    
    .dash-btn-delete {
        background-color: #f8fafc;
        color: #ef4444;
    }
    
    .dash-btn-delete:hover {
        background-color: #fef2f2;
        border-color: #ef4444;
    }
    


        /* Styling untuk Addresses */
        .dash-address-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }
        
        .dash-address-card {
            border: 1px solid #e9ecef;
            border-radius: 10px;
            padding: 20px;
            transition: all 0.3s;
            position: relative;
        }
        
        .dash-address-card:hover {
            border-color: #5b73e8;
            transform: translateY(-3px);
        }
        
        .dash-address-default {
            position: absolute;
            top: 20px;
            right: 20px;
            padding: 3px 10px;
            background: #e6f7ee;
            color: #00a76f;
            border-radius: 12px;
            font-size: 12px;
        }
        
        .dash-address-type {
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 10px;
        }
        
        .dash-address-details {
            color: #525f7f;
            line-height: 1.6;
            margin-bottom: 15px;
        }
        
        /* Styling untuk Account Settings */    .dash-profile {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 30px;
            padding: 0 25px 25px;
            border-bottom: 1px solid #f1f5f9;
        }
        
        .dash-avatar {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 36px;
            margin-bottom: 15px;
            overflow: hidden;
        }
        
        .dash-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .dash-userinfo {
            text-align: center;
        }
        
        .dash-userinfo h3 {
            color: #1e293b;
            margin-bottom: 5px;
            font-size: 18px;
            font-weight: 600;
        }
        
        .dash-userinfo p {
            color: #64748b;
            font-size: 14px;
            margin: 0;
        }
        
        .dash-menu {
            list-style: none;
            padding: 10px 0;
            margin: 0;
        }
        
        .dash-menuitem {
            padding: 14px 25px;
            display: flex;
            align-items: center;
            cursor: pointer;
            transition: all 0.2s;
            color: #64748b;
            font-weight: 500;
            margin: 4px 10px;
            border-radius: 10px;
        }
        
        .dash-menuitem:hover {
            background-color: #f8fafc;
            color: #6366f1;
        }
        
        .dash-menuitem.dash-active {
            background-color: #f1f5f9;
            color: #4f46e5;
            font-weight: 600;
        }
        
        .dash-icon {
            margin-right: 14px;
            font-size: 18px;
            width: 22px;
            text-align: center;
        }
        
        .dash-content {
            flex: 1;
            border-radius: 16px;
        }
        
        .dash-card {
            background-color: white;
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            padding: 30px;
            margin-bottom: 25px;
        }
        
        .dash-header {
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid #f1f5f9;
        }
        
        .dash-header h2 {
            color: #1e293b;
            font-size: 24px;
            margin-bottom: 8px;
            font-weight: 700;
        }
        
        .dash-header p {
            color: #64748b;
            font-size: 15px;
            margin: 0;
        }
        
        /* Styling untuk Account Settings */
        .dash-settings-container {
            display: grid;
            grid-template-columns: 1fr;
            gap: 0;
        }
        
        .dash-settings-section {
            margin-bottom: 32px;
        }
        
        .dash-settings-section:last-child {
            margin-bottom: 0;
        }
        
        .dash-settings-section-title {
            font-size: 17px;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }
        
        .dash-settings-section-title i {
            margin-right: 12px;
            color: #6366f1;
            background: #f1f5f9;
            width: 36px;
            height: 36px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .dash-form-group {
            margin-bottom: 20px;
        }
        
        .dash-form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #374151;
            font-size: 14px;
        }
        
        .dash-form-group input {
            width: 100%;
            padding: 14px 16px;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            font-size: 15px;
            transition: all 0.2s;
            box-sizing: border-box;
            background-color: #ffffff; /* Diubah dari #f8fafc ke #ffffff */
        }
        
        .dash-form-group input:focus {
            outline: none;
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
            background-color: white;
        }
        
        .dash-form-hint {
            font-size: 13px;
            color: #64748b;
            margin-top: 6px;
        }
        
        .dash-settings-actions {
            display: flex;
            gap: 12px;
            margin-top: 30px;
            padding-top: 25px;
            border-top: 1px solid #f1f5f9;
        }
        
        .dash-btn {
            padding: 14px 24px;
            border-radius: 10px;
            border: none;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
        }
        
        .dash-btn i {
            margin-right: 8px;
        }
        
        .dash-btn-main {
            background-color: #4f46e5;
            color: white;
        }
        
        .dash-btn-main:hover {
            background-color: #4338ca;
        }
        
        .dash-btn-secondary {
            background-color: #f8fafc;
            color: #64748b;
            border: 1px solid #e2e8f0;
        }
        
        .dash-btn-secondary:hover {
            background-color: #f1f5f9;
        }
        
        .dash-notification-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 18px 0;
            border-bottom: 1px solid #f1f5f9;
        }
        
        .dash-notification-item:last-child {
            border-bottom: none;
        }
        
        .dash-notification-info h5 {
            margin: 0 0 4px 0;
            font-size: 15px;
            font-weight: 500;
            color: #374151;
        }
        
        .dash-notification-info p {
            margin: 0;
            color: #64748b;
            font-size: 14px;
        }
        
        .dash-switch {
            position: relative;
            display: inline-block;
            width: 44px;
            height: 22px;
        }
        
        .dash-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }
        
        .dash-slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #cbd5e1;
            transition: .3s;
            border-radius: 22px;
        }
        
        .dash-slider:before {
            position: absolute;
            content: "";
            height: 18px;
            width: 18px;
            left: 2px;
            bottom: 2px;
            background-color: white;
            transition: .3s;
            border-radius: 50%;
        }
        
        input:checked + .dash-slider {
            background-color: #4f46e5;
        }
        
        input:checked + .dash-slider:before {
            transform: translateX(22px);
        }
        
        
        /* Responsive */
        @media (max-width: 992px) {
            .dash-container {
                flex-direction: column;
                padding: 0 15px;
            }
            
            .dash-sidebar {
                width: 100%;
                margin-bottom: 20px;
            }
            
            .dash-wishgrid,
            .dash-payment-methods,
            .dash-address-grid {
                grid-template-columns: 1fr;
            }
        }
            /* Responsive */
    @media (max-width: 768px) {
        .dash-review-header {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .dash-review-rating {
            flex-direction: row;
            align-items: center;
            gap: 10px;
        }
        
        .dash-review-meta {
            gap: 10px;
        }
        
        .dash-review-actions {
            justify-content: flex-start;
            flex-wrap: wrap;
        }
    }
    </style>
</head>
<body>
<div class="breadcrumb-nav" data-aos="fade-down" data-aos-duration="500">
    <div class="breadcrumb-title"> Akun</div>
    <div class="breadcrumb-links">
      <a href="#"> Beranda</a>
      <span>/</span>
      <a href="#">Akun</a>
    </div>
</div>

    <div class="dash-container pt-5">
        <!-- Sidebar (Kiri) -->
        <div class="dash-sidebar">
            <div class="dash-profile">
                <div class="dash-avatar">
                    <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=100&q=80" alt="Profile">
                </div>
                <div class="dash-userinfo">
                    <h3>Sarah Anderson</h3>
                    <p>Premium Member</p>
                </div>
            </div>
            
        <ul class="dash-menu">
<li class="dash-menuitem dash-active" data-target="orders">
    <span class="dash-icon"><i class="far fa-credit-card"></i></span>
    <span>My Orders</span>
</li>
    <li class="dash-menuitem" data-target="promo">
        <span class="dash-icon"><i class="far fa-percent"></i></span>
        <span>Promo & Voucher</span>
    </li>
    <li class="dash-menuitem" data-target="reviews">
        <span class="dash-icon"><i class="far fa-edit"></i></span>
        <span>My Reviews</span>
    </li>
    <li class="dash-menuitem" data-target="wishlist">
        <span class="dash-icon"><i class="far fa-heart"></i></span>
        <span>Wishlist</span>
    </li>
    <li class="dash-menuitem" data-target="settings">
        <span class="dash-icon"><i class="far fa-user"></i></span>
        <span>Account Settings</span>
    </li>
</ul>


        </div>
        
        <!-- Konten Area (Kanan) -->
        <div class="dash-content ">
            <!-- Konten My Orders -->
            <div class="dash-card dash-content-section" id="orders">
                <div class="dash-header">
                    <h2>My Orders</h2>
                    <p>Your recent orders and their status</p>
                </div>
                
                <div class="dash-body">
                    <ul class="dash-orderlist">
                        <li class="dash-order">
                            <div class="dash-orderinfo">
                                <h5>Order #12345 - Wireless Headphones</h5>
                                <p>Placed on August 30, 2025</p>
                                <p>Total: $125.99</p>
                            </div>
                            <div class="dash-status dash-status-delivered">Delivered</div>
                        </li>
                        <li class="dash-order">
                            <div class="dash-orderinfo">
                                <h5>Order #12346 - Running Shoes</h5>
                                <p>Placed on August 28, 2025</p>
                                <p>Total: $89.50</p>
                            </div>
                            <div class="dash-status dash-status-processing">Processing</div>
                        </li>
                        <li class="dash-order">
                            <div class="dash-orderinfo">
                                <h5>Order #12347 - Smart Watch</h5>
                                <p>Placed on August 25, 2025</p>
                                <p>Total: $215.75</p>
                            </div>
                            <div class="dash-status dash-status-delivered">Delivered</div>
                        </li>
                        <li class="dash-order">
                            <div class="dash-orderinfo">
                                <h5>Order #12348 - Casual T-Shirt</h5>
                                <p>Placed on August 22, 2025</p>
                                <p>Total: $76.25</p>
                            </div>
                            <div class="dash-status dash-status-shipped">Shipped</div>
                        </li>
                    </ul>
                </div>
            </div>
            
            <!-- Konten Wishlist -->
          <div class="dash-card dash-content-section" id="wishlist" style="display: none;">
    <div class="dash-header">
        <h2>Favorit Saya</h2>
        <p>Layanan yang Anda simpan untuk dinikmati nanti</p>
    </div>
    
    <div class="dash-body">
        <div class="dash-wishgrid">
            <!-- Item 1 - Paket Jeep -->
            <div class="dash-wishitem">
                <div class="dash-wishimg" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                    <i class="fas fa-car fa-3x"></i>
                </div>
                <div class="dash-wishdetails">
                    <h5>Paket Jeep Sunrise Bromo</h5>
                    <div class="dash-wishprice">
                        <span class="dash-price">Rp 950.000</span>
                        <span class="dash-price-original">Rp 1.200.000</span>
                    </div>
                    <div class="dash-wishmeta">
                        <span><i class="fas fa-clock"></i> 5 jam</span>
                        <span><i class="fas fa-user-friends"></i> Maks. 4 orang</span>
                    </div>
                    <div class="dash-wishactions">
                        <button class="dash-btn dash-btn-main">
                            <i class="fas fa-calendar-check"></i> Pesan Sekarang
                        </button>
                        <button class="dash-wishremove">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Item 2 - Motor Trail -->
            <div class="dash-wishitem">
                <div class="dash-wishimg" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                    <i class="fas fa-motorcycle fa-3x"></i>
                </div>
                <div class="dash-wishdetails">
                    <h5>Honda CRF150L Trail</h5>
                    <div class="dash-wishprice">
                        <span class="dash-price">Rp 320.000</span>
                        <span class="dash-price-original">Rp 400.000</span>
                    </div>
                    <div class="dash-wishmeta">
                        <span><i class="fas fa-clock"></i> 8 jam</span>
                        <span><i class="fas fa-helmet-safety"></i> Helm included</span>
                    </div>
                    <div class="dash-wishactions">
                        <button class="dash-btn dash-btn-main">
                            <i class="fas fa-calendar-check"></i> Pesan Sekarang
                        </button>
                        <button class="dash-wishremove">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Item 3 - Paket Private -->
            <div class="dash-wishitem">
                <div class="dash-wishimg" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                    <i class="fas fa-route fa-3x"></i>
                </div>
                <div class="dash-wishdetails">
                    <h5>Private Tour Savana</h5>
                    <div class="dash-wishprice">
                        <span class="dash-price">Rp 1.500.000</span>
                        <span class="dash-price-original">Rp 1.800.000</span>
                    </div>
                    <div class="dash-wishmeta">
                        <span><i class="fas fa-clock"></i> 6-8 jam</span>
                        <span><i class="fas fa-utensils"></i> Lunch included</span>
                    </div>
                    <div class="dash-wishactions">
                        <button class="dash-btn dash-btn-main">
                            <i class="fas fa-calendar-check"></i> Pesan Sekarang
                        </button>
                        <button class="dash-wishremove">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Item 4 - Advanced Package -->
            <div class="dash-wishitem">
                <div class="dash-wishimg" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">
                    <i class="fas fa-bolt fa-3x"></i>
                </div>
                <div class="dash-wishdetails">
                    <h5>Advanced Trail Package</h5>
                    <div class="dash-wishprice">
                        <span class="dash-price">Rp 750.000</span>
                        <span class="dash-price-original">Rp 850.000</span>
                    </div>
                    <div class="dash-wishmeta">
                        <span><i class="fas fa-clock"></i> 10 jam</span>
                        <span><i class="fas fa-user-shield"></i> Guide included</span>
                    </div>
                    <div class="dash-wishactions">
                        <button class="dash-btn dash-btn-main">
                            <i class="fas fa-calendar-check"></i> Pesan Sekarang
                        </button>
                        <button class="dash-wishremove">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Item 5 - Family Package -->
            <div class="dash-wishitem">
                <div class="dash-wishimg" style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);">
                    <i class="fas fa-users fa-3x"></i>
                </div>
                <div class="dash-wishdetails">
                    <h5>Family Jeep Adventure</h5>
                    <div class="dash-wishprice">
                        <span class="dash-price">Rp 1.200.000</span>
                        <span class="dash-price-original">Rp 1.500.000</span>
                    </div>
                    <div class="dash-wishmeta">
                        <span><i class="fas fa-clock"></i> 4 jam</span>
                        <span><i class="fas fa-child"></i> Keluarga friendly</span>
                    </div>
                    <div class="dash-wishactions">
                        <button class="dash-btn dash-btn-main">
                            <i class="fas fa-calendar-check"></i> Pesan Sekarang
                        </button>
                        <button class="dash-wishremove">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Item 6 - Night Package -->
            <div class="dash-wishitem">
                <div class="dash-wishimg" style="background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);">
                    <i class="fas fa-moon fa-3x"></i>
                </div>
                <div class="dash-wishdetails">
                    <h5>Sunset & Stargazing</h5>
                    <div class="dash-wishprice">
                        <span class="dash-price">Rp 850.000</span>
                        <span class="dash-price-original">Rp 1.000.000</span>
                    </div>
                    <div class="dash-wishmeta">
                        <span><i class="fas fa-clock"></i> Sore-Malam</span>
                        <span><i class="fas fa-camera"></i> Photo session</span>
                    </div>
                    <div class="dash-wishactions">
                        <button class="dash-btn dash-btn-main">
                            <i class="fas fa-calendar-check"></i> Pesan Sekarang
                        </button>
                        <button class="dash-wishremove">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
            
            <!-- Konten Payment Methods -->

            <div class="dash-card dash-content-section" id="promo" style="display: none;">
    <div class="dash-header">
        <h2>Promo & Voucher</h2>
        <p>Nikmati penawaran spesial untuk adventure bersama kami!</p>
    </div>
    
    <div class="dash-body">
        <!-- Tab Navigation -->
        <div class="dash-promo-tabs">
            <button class="dash-tab-btn dash-tab-active" data-tab="available">Promo Tersedia</button>
            <button class="dash-tab-btn" data-tab="jeep">Paket Jeep</button>
            <button class="dash-tab-btn" data-tab="motor">Paket Motor Trail</button>
            <button class="dash-tab-btn" data-tab="used">Promo Terpakai</button>
        </div>
        
        <!-- Promo yang Tersedia -->
        <div class="dash-promo-content dash-tab-content pt-3" id="available-promos">
            <div class="dash-promo-grid">
                <!-- Kartu Promo 1 -->
                <div class="dash-promo-card dash-promo-primary">
                    <div class="dash-promo-badge">TERPOPULER</div>
                    <div class="dash-promo-header">
                        <div class="dash-promo-icon">
                            <i class="fas fa-car"></i>
                        </div>
                        <div class="dash-promo-value">
                            <h3>DISKON 20%</h3>
                            <p>Weekend Jeep Adventure</p>
                        </div>
                    </div>
                    <div class="dash-promo-code">
                        <span>JEEPWEEKEND20</span>
                        <button class="dash-promo-copy">
                            <i class="far fa-copy"></i>
                        </button>
                    </div>
                    <p class="dash-promo-desc">Berlaku setiap Sabtu & Minggu</p>
                    <button class="dash-btn dash-btn-main dash-promo-apply">Gunakan Kode</button>
                </div>
                
                <!-- Kartu Promo 2 -->
                <div class="dash-promo-card dash-promo-secondary">
                    <div class="dash-promo-badge">BARU</div>
                    <div class="dash-promo-header">
                        <div class="dash-promo-icon">
                            <i class="fas fa-motorcycle"></i>
                        </div>
                        <div class="dash-promo-value">
                            <h3>GRATIS 1 JAM</h3>
                            <p>Motor Trail Rental</p>
                        </div>
                    </div>
                    <div class="dash-promo-code">
                        <span>TRAILGRATIS1JAM</span>
                        <button class="dash-promo-copy">
                            <i class="far fa-copy"></i>
                        </button>
                    </div>
                    <p class="dash-promo-desc">Min. rental 5 jam</p>
                    <button class="dash-btn dash-btn-main dash-promo-apply">Gunakan Kode</button>
                </div>
                
                <!-- Kartu Promo 3 -->
                <div class="dash-promo-card dash-promo-success">
                    <div class="dash-promo-header">
                        <div class="dash-promo-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="dash-promo-value">
                            <h3>PAKET GRUP</h3>
                            <p>5 Jeep = 1 Gratis</p>
                        </div>
                    </div>
                    <div class="dash-promo-code">
                        <span>GRUP5JEEP</span>
                        <button class="dash-promo-copy">
                            <i class="far fa-copy"></i>
                        </button>
                    </div>
                    <p class="dash-promo-desc">Minimal 5 jeep untuk 1 grup</p>
                    <button class="dash-btn dash-btn-main dash-promo-apply">Gunakan Kode</button>
                </div>
            </div>
        </div>
        
        <!-- Paket Jeep -->
        <div class="dash-promo-content dash-tab-content pt-3" id="jeep-promos" style="display: none;">
            <div class="dash-promo-grid">
                <!-- Paket Jeep 1 -->
                <div class="dash-promo-card dash-promo-warning">
                    <div class="dash-promo-badge">RECOMMENDED</div>
                    <div class="dash-promo-header">
                        <div class="dash-promo-icon">
                            <i class="fas fa-sun"></i>
                        </div>
                        <div class="dash-promo-value">
                            <h3>SUNRISE TOUR</h3>
                            <p>Jeep + Guide + Breakfast</p>
                        </div>
                    </div>
                    <div class="dash-promo-detail">
                        <p><i class="fas fa-clock"></i> 4-5 jam tour</p>
                        <p><i class="fas fa-map-marked-alt"></i> Gunung Bromo</p>
                        <p><i class="fas fa-user-friends"></i> Maks. 4 orang/jeep</p>
                    </div>
                    <div class="dash-promo-price">
                        <span class="dash-price-old">Rp 1.200.000</span>
                        <span class="dash-price-new">Rp 950.000</span>
                    </div>
                    <button class="dash-btn dash-btn-main dash-promo-apply">Pesan Sekarang</button>
                </div>
                
                <!-- Paket Jeep 2 -->
                <div class="dash-promo-card dash-promo-primary">
                    <div class="dash-promo-header">
                        <div class="dash-promo-icon">
                            <i class="fas fa-tree"></i>
                        </div>
                        <div class="dash-promo-value">
                            <h3>FULL DAY ADVENTURE</h3>
                            <p>Jeep + Lunch + Photo Session</p>
                        </div>
                    </div>
                    <div class="dash-promo-detail">
                        <p><i class="fas fa-clock"></i> 8-10 jam tour</p>
                        <p><i class="fas fa-map-marked-alt"></i> Bromo & Savana</p>
                        <p><i class="fas fa-user-friends"></i> Maks. 4 orang/jeep</p>
                    </div>
                    <div class="dash-promo-price">
                        <span class="dash-price-old">Rp 1.800.000</span>
                        <span class="dash-price-new">Rp 1.500.000</span>
                    </div>
                    <button class="dash-btn dash-btn-main dash-promo-apply">Pesan Sekarang</button>
                </div>
            </div>
        </div>
        
        <!-- Paket Motor Trail -->
        <div class="dash-promo-content dash-tab-content pt-3" id="motor-promos" style="display: none;">
            <div class="dash-promo-grid">
                <!-- Paket Motor 1 -->
                <div class="dash-promo-card dash-promo-danger">
                    <div class="dash-promo-badge">HOT DEAL</div>
                    <div class="dash-promo-header">
                        <div class="dash-promo-icon">
                            <i class="fas fa-bolt"></i>
                        </div>
                        <div class="dash-promo-value">
                            <h3>TRAIL BEGINNER</h3>
                            <p>Honda CRF150L</p>
                        </div>
                    </div>
                    <div class="dash-promo-detail">
                        <p><i class="fas fa-clock"></i> Per 8 jam</p>
                        <p><i class="fas fa-helmet-safety"></i> Helm included</p>
                        <p><i class="fas fa-map"></i> Jalur easy-medium</p>
                    </div>
                    <div class="dash-promo-price">
                        <span class="dash-price-old">Rp 400.000</span>
                        <span class="dash-price-new">Rp 320.000</span>
                    </div>
                    <button class="dash-btn dash-btn-main dash-promo-apply">Pesan Sekarang</button>
                </div>
                
                <!-- Paket Motor 2 -->
                <div class="dash-promo-card dash-promo-success">
                    <div class="dash-promo-header">
                        <div class="dash-promo-icon">
                            <i class="fas fa-fire"></i>
                        </div>
                        <div class="dash-promo-value">
                            <h3>ADVANCED TRAIL</h3>
                            <p>Yamaha WR155R</p>
                        </div>
                    </div>
                    <div class="dash-promo-detail">
                        <p><i class="fas fa-clock"></i> Per 8 jam</p>
                        <p><i class="fas fa-helmet-safety"></i> Full gear included</p>
                        <p><i class="fas fa-map"></i> Jalur medium-hard</p>
                    </div>
                    <div class="dash-promo-price">
                        <span class="dash-price-old">Rp 550.000</span>
                        <span class="dash-price-new">Rp 450.000</span>
                    </div>
                    <button class="dash-btn dash-btn-main dash-promo-apply">Pesan Sekarang</button>
                </div>
                
                <!-- Paket Motor 3 -->
                <div class="dash-promo-card dash-promo-info">
                    <div class="dash-promo-badge">GUIDE INCLUDED</div>
                    <div class="dash-promo-header">
                        <div class="dash-promo-icon">
                            <i class="fas fa-route"></i>
                        </div>
                        <div class="dash-promo-value">
                            <h3>FULL PACKAGE</h3>
                            <p>Motor + Guide + Lunch</p>
                        </div>
                    </div>
                    <div class="dash-promo-detail">
                        <p><i class="fas fa-clock"></i> Full day (10 jam)</p>
                        <p><i class="fas fa-helmet-safety"></i> Full gear included</p>
                        <p><i class="fas fa-map"></i> Private trail route</p>
                    </div>
                    <div class="dash-promo-price">
                        <span class="dash-price-old">Rp 850.000</span>
                        <span class="dash-price-new">Rp 750.000</span>
                    </div>
                    <button class="dash-btn dash-btn-main dash-promo-apply">Pesan Sekarang</button>
                </div>
            </div>
        </div>
        
        <!-- Status Kosong (untuk tab terpakai) -->
        <div class="dash-promo-empty pt-3" id="used-promos" style="display: none;">
            <div class="dash-empty-state">
                <i class="far fa-clock"></i>
                <h3>Belum Ada Promo Terpakai</h3>
                <p>Anda belum menggunakan promo apa pun</p>
            </div>
        </div>
    </div>
</div>
            <!-- Konten My Reviews -->
<div class="dash-card dash-content-section" id="reviews" style="display: none;">
    <div class="dash-header">
        <h2>Ulasan Saya</h2>
        <p>Pengalaman dan penilaian Anda terhadap layanan kami</p>
    </div>
    
    <div class="dash-body">
        <!-- Daftar Ulasan -->
        <div class="dash-reviews-container">
            <!-- Ulasan 1 -->
            <div class="dash-review">
                <div class="dash-review-header">
                    <div class="dash-review-info">
                        <div class="dash-review-service">Paket Jeep Sunrise Bromo</div>
                        <div class="dash-review-date">30 Agustus 2025</div>
                    </div>
                    <div class="dash-review-rating">
                        <div class="dash-review-stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <span class="dash-rating-text">Sangat Memuaskan</span>
                    </div>
                </div>
                
                <div class="dash-review-content">
                    <p>Pengalaman luar biasa! Pemandu sangat profesional dan knowledgeable tentang area Bromo. Jeep dalam kondisi prima dan nyaman untuk medan yang cukup challenging. Sunrise di Penanjakan benar-benar spektakuler. Recommended banget!</p>
                </div>
                
                <div class="dash-review-meta">
                    <span class="dash-review-guide"><i class="fas fa-user"></i> Pemandu: Budi</span>
                    <span class="dash-review-duration"><i class="fas fa-clock"></i> Durasi: 5 jam</span>
                    <span class="dash-review-vehicle"><i class="fas fa-car"></i> Jeep: Toyota Land Cruiser</span>
                </div>

                <!-- Tombol Aksi -->
                <div class="dash-review-actions">
                    <button class="dash-btn-edit">
                        <i class="fas fa-edit"></i> Edit Ulasan
                    </button>
                    <button class="dash-btn-delete">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </div>
            </div>
            
            <!-- Ulasan 2 -->
            <div class="dash-review">
                <div class="dash-review-header">
                    <div class="dash-review-info">
                        <div class="dash-review-service">Sewa Motor Trail Honda CRF</div>
                        <div class="dash-review-date">25 Agustus 2025</div>
                    </div>
                    <div class="dash-review-rating">
                        <div class="dash-review-stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <span class="dash-rating-text">Memuaskan</span>
                    </div>
                </div>
                
                <div class="dash-review-content">
                    <p>Motor dalam kondisi bagus dan terawat. Untuk trail medium sangat cocok, respon mesin masih bagus. Hanya saja helm yang disediakan agak kurang nyaman untuk pemakaian lama. Secara keseluruhan puas dengan pelayanannya.</p>
                </div>
                
                <div class="dash-review-meta">
                    <span class="dash-review-duration"><i class="fas fa-clock"></i> Durasi: 8 jam</span>
                    <span class="dash-review-vehicle"><i class="fas fa-motorcycle"></i> Motor: Honda CRF150L</span>
                </div>

                <!-- Tombol Aksi -->
                <div class="dash-review-actions">
                    <button class="dash-btn-edit">
                        <i class="fas fa-edit"></i> Edit Ulasan
                    </button>
                    <button class="dash-btn-delete">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </div>
            </div>

            <!-- Ulasan 3 -->
            <div class="dash-review">
                <div class="dash-review-header">
                    <div class="dash-review-info">
                        <div class="dash-review-service">Private Jeep Tour Savana</div>
                        <div class="dash-review-date">20 Agustus 2025</div>
                    </div>
                    <div class="dash-review-rating">
                        <div class="dash-review-stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                        </div>
                        <span class="dash-rating-text">Cukup Memuaskan</span>
                    </div>
                </div>
                
                <div class="dash-review-content">
                    <p>Tour yang seru dan pemandangan savana yang indah. Sayangnya jeep yang kami dapatkan agak berisik dan AC kurang dingin. Pemandu cukup helpful tapi kurang komunikatif. Harga sesuai dengan experience yang diberikan.</p>
                </div>
                
                <div class="dash-review-meta">
                    <span class="dash-review-guide"><i class="fas fa-user"></i> Pemandu: Ahmad</span>
                    <span class="dash-review-duration"><i class="fas fa-clock"></i> Durasi: 6 jam</span>
                    <span class="dash-review-vehicle"><i class="fas fa-car"></i> Jeep: Suzuki Jimny</span>
                </div>

                <!-- Tombol Aksi -->
                <div class="dash-review-actions">
                    <button class="dash-btn-edit">
                        <i class="fas fa-edit"></i> Edit Ulasan
                    </button>
                    <button class="dash-btn-delete">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </div>
            </div>

            <!-- Ulasan 4 -->
            <div class="dash-review">
                <div class="dash-review-header">
                    <div class="dash-review-info">
                        <div class="dash-review-service">Advanced Trail Package</div>
                        <div class="dash-review-date">15 Agustus 2025</div>
                    </div>
                    <div class="dash-review-rating">
                        <div class="dash-review-stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <span class="dash-rating-text">Sangat Memuaskan</span>
                    </div>
                </div>
                
                <div class="dash-review-content">
                    <p>Worth every penny! Motor Yamaha WR250R kondisi sangat prima, gear lengkap dan nyaman. Pemandu expert banget dan tau spot-trail yang challenging tapi aman. Lunch di pinggir sungai jadi highlight trip kami. Pasti akan repeat lagi!</p>
                </div>
                
                <div class="dash-review-meta">
                    <span class="dash-review-guide"><i class="fas fa-user"></i> Pemandu: Rudi</span>
                    <span class="dash-review-duration"><i class="fas fa-clock"></i> Durasi: 10 jam</span>
                    <span class="dash-review-vehicle"><i class="fas fa-motorcycle"></i> Motor: Yamaha WR250R</span>
                </div>

                <!-- Tombol Aksi -->
                <div class="dash-review-actions">
                    <button class="dash-btn-edit">
                        <i class="fas fa-edit"></i> Edit Ulasan
                    </button>
                    <button class="dash-btn-delete">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
            
            <!-- Konten Addresses -->
            <div class="dash-card dash-content-section" id="addresses" style="display: none;">
                <div class="dash-header">
                    <h2>Addresses</h2>
                    <p>Your saved delivery addresses</p>
                </div>
                
                <div class="dash-body">
                    <div class="dash-address-grid">
                        <div class="dash-address-card">
                            <div class="dash-address-default">Default</div>
                            <div class="dash-address-type">Home Address</div>
                            <div class="dash-address-details">
                                Sarah Anderson<br>
                                123 Main Street<br>
                                Apartment 4B<br>
                                New York, NY 10001<br>
                                United States
                            </div>
                            <button class="dash-btn dash-btn-main">Edit Address</button>
                        </div>
                        
                        <div class="dash-address-card">
                            <div class="dash-address-type">Work Address</div>
                            <div class="dash-address-details">
                                Sarah Anderson<br>
                                456 Office Park<br>
                                Building C, Suite 300<br>
                                New York, NY 10002<br>
                                United States
                            </div>
                            <button class="dash-btn dash-btn-main">Edit Address</button>
                        </div>
                    </div>
                    
                    <button class="dash-btn dash-btn-main" style="margin-top: 25px;">
                        <i class="fas fa-plus"></i> Add New Address
                    </button>
                </div>
            </div>
            
         <div class="dash-card dash-content-section" id="settings">
                <div class="dash-header">
                    <div>
                        <h2>Account Settings</h2>
                        <p>Manage your profile and account preferences</p>
                    </div>
                </div>
                
                <div class="dash-body">
                    <div class="dash-settings-container">
                        <div class="dash-settings-section">
                            <div class="dash-settings-section-title">
                                <i class="fas fa-user"></i>Profile Information
                            </div>
                            
                            <div class="dash-form-group">
                                <label for="name">Full Name</label>
                                <input type="text" id="name" value="Sarah Anderson">
                            </div>
                            
                            <div class="dash-form-group">
                                <label for="email">Email Address</label>
                                <input type="email" id="email" value="sarah.anderson@example.com">
                            </div>
                            
                            <div class="dash-form-group">
                                <label for="phone">Phone Number</label>
                                <input type="tel" id="phone" value="+1 (555) 123-4567">
                            </div>
                        </div>
                        
                        <div class="dash-settings-section">
                            <div class="dash-settings-section-title">
                                <i class="fas fa-lock"></i>Password
                            </div>
                            
                            <div class="dash-form-group">
                                <label for="new-password">New Password</label>
                                <input type="password" id="new-password" placeholder="Enter new password">
                                <p class="dash-form-hint">Use at least 8 characters with a mix of letters and numbers</p>
                            </div>
                            
                            <div class="dash-form-group">
                                <label for="confirm-password">Confirm New Password</label>
                                <input type="password" id="confirm-password" placeholder="Confirm your new password">
                            </div>
                        </div>
                        
                        <div class="dash-settings-section">
                            <div class="dash-settings-section-title">
                                <i class="fas fa-bell"></i>Notification Preferences
                            </div>
                            
                            <div class="dash-notification-item">
                                <div class="dash-notification-info">
                                    <h5>Email Notifications</h5>
                                    <p>Receive order updates via email</p>
                                </div>
                                <label class="dash-switch">
                                    <input type="checkbox" checked>
                                    <span class="dash-slider"></span>
                                </label>
                            </div>
                            
                            <div class="dash-notification-item">
                                <div class="dash-notification-info">
                                    <h5>Promotional Emails</h5>
                                    <p>Get updates about new products and offers</p>
                                </div>
                                <label class="dash-switch">
                                    <input type="checkbox">
                                    <span class="dash-slider"></span>
                                </label>
                            </div>
                            
                            <div class="dash-notification-item">
                                <div class="dash-notification-info">
                                    <h5>Push Notifications</h5>
                                    <p>Get alerts on your device</p>
                                </div>
                                <label class="dash-switch">
                                    <input type="checkbox" checked>
                                    <span class="dash-slider"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="dash-settings-actions">
                        <button class="dash-btn dash-btn-main">
                            <i class="fas fa-save"></i> Save Changes
                        </button>
                        <button class="dash-btn dash-btn-secondary">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuItems = document.querySelectorAll('.dash-menuitem');
            const contentSections = document.querySelectorAll('.dash-content-section');
            
            // Sembunyikan semua konten kecuali yang pertama
            for (let i = 1; i < contentSections.length; i++) {
                contentSections[i].style.display = 'none';
            }
            
            menuItems.forEach((item) => {
                item.addEventListener('click', function() {
                    // Remove active class from all items
                    menuItems.forEach(i => i.classList.remove('dash-active'));
                    
                    // Add active class to clicked item
                    this.classList.add('dash-active');
                    
                    // Get target section
                    const targetId = this.getAttribute('data-target');
                    
                    // Sembunyikan semua konten
                    contentSections.forEach(section => {
                        section.style.display = 'none';
                    });
                    
                    // Tampilkan konten yang sesuai
                    document.getElementById(targetId).style.display = 'block';
                });
            });
        });
    </script>
    <script>
    // Tab functionality for promo section
    document.addEventListener('DOMContentLoaded', function() {
        const tabButtons = document.querySelectorAll('.dash-tab-btn');
        const tabContents = document.querySelectorAll('.dash-tab-content, .dash-promo-empty');
        
        tabButtons.forEach(button => {
            button.addEventListener('click', () => {
                const tabId = button.getAttribute('data-tab');
                
                // Update active tab
                tabButtons.forEach(btn => btn.classList.remove('dash-tab-active'));
                button.classList.add('dash-tab-active');
                
                // Show corresponding content
                tabContents.forEach(content => {
                    if (content.id === `${tabId}-promos`) {
                        content.style.display = 'block';
                    } else {
                        content.style.display = 'none';
                    }
                });
            });
        });
        
        // Copy promo code functionality
        document.querySelectorAll('.dash-promo-copy').forEach(button => {
            button.addEventListener('click', function() {
                const promoCode = this.parentElement.querySelector('span').textContent;
                navigator.clipboard.writeText(promoCode).then(() => {
                    const originalIcon = this.innerHTML;
                    this.innerHTML = '<i class="fas fa-check"></i>';
                    setTimeout(() => {
                        this.innerHTML = originalIcon;
                    }, 2000);
                });
            });
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Fungsi Edit Ulasan
        document.querySelectorAll('.dash-btn-edit').forEach(button => {
            button.addEventListener('click', function() {
                const reviewCard = this.closest('.dash-review');
                const reviewId = reviewCard.dataset.reviewId; // Anda bisa menambahkan data-review-id pada setiap card
                
                // Simulasi fungsi edit - bisa diganti dengan modal atau form edit
                alert('Fungsi edit ulasan akan dibuka untuk ulasan ID: ' + (reviewId || 'unknown'));
                // Di sini Anda bisa membuka modal edit atau redirect ke halaman edit
            });
        });
        
        // Fungsi Hapus Ulasan
        document.querySelectorAll('.dash-btn-delete').forEach(button => {
            button.addEventListener('click', function() {
                const reviewCard = this.closest('.dash-review');
                const reviewId = reviewCard.dataset.reviewId; // Anda bisa menambahkan data-review-id pada setiap card
                
                // Konfirmasi sebelum menghapus
                if (confirm('Apakah Anda yakin ingin menghapus ulasan ini?')) {
                    // Simulasi penghapusan
                    reviewCard.style.opacity = '0.5';
                    alert('Ulasan dengan ID: ' + (reviewId || 'unknown') + ' akan dihapus');
                    
                    // Di sini Anda bisa menambahkan AJAX request untuk menghapus dari database
                    // Setelah berhasil, hapus elemen dari DOM:
                    // reviewCard.remove();
                }
            });
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Fungsi hapus dari wishlist
        document.querySelectorAll('.dash-wishremove').forEach(button => {
            button.addEventListener('click', function() {
                const wishItem = this.closest('.dash-wishitem');
                const itemName = wishItem.querySelector('h5').textContent;
                
                if (confirm(`Hapus "${itemName}" dari favorit?`)) {
                    // Animasi penghapusan
                    wishItem.style.opacity = '0';
                    wishItem.style.transform = 'translateX(100px)';
                    
                    setTimeout(() => {
                        wishItem.remove();
                        
                        // Cek jika wishlist kosong
                        if (document.querySelectorAll('.dash-wishitem').length === 0) {
                            const emptyState = document.createElement('div');
                            emptyState.className = 'dash-empty-state';
                            emptyState.innerHTML = `
                                <i class="far fa-heart" style="font-size: 48px; color: #cbd5e1; margin-bottom: 15px;"></i>
                                <h3>Favorit Kosong</h3>
                                <p>Anda belum menambahkan layanan ke favorit</p>
                            `;
                            document.querySelector('.dash-wishgrid').appendChild(emptyState);
                        }
                    }, 300);
                }
            });
        });
        
        // Fungsi pesan sekarang
        document.querySelectorAll('.dash-wishactions .dash-btn').forEach(button => {
            button.addEventListener('click', function() {
                const wishItem = this.closest('.dash-wishitem');
                const itemName = wishItem.querySelector('h5').textContent;
                alert(`Membuka halaman pemesanan untuk: ${itemName}`);
                // Redirect ke halaman pemesanan sesuai item
            });
        });
    });
</script>
</body>
</html>