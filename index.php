<?php
include 'db.php';
$result = $conn->query("select * from menu");
?>
<!doctype html>
<html lang="en">
<head>
    <title>Food Plaza | Home</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous"/>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&family=Playfair+Display:wght@700&display=swap" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet"/>
    <style>
        :root {
            --red:#D93B2B; --red2:#B52E1E; --orange:#E8602A;
            --cream:#FDF6EE; --dark:#1C1008; --card-bg:#FFFFFF;
            --text:#2D1A0E; --muted:#8A6A55; --green:#2E7D32;
            --shadow:0 8px 32px rgba(180,50,30,.13);
        }
        *{box-sizing:border-box;margin:0;padding:0;}
        body{font-family:'Poppins',sans-serif;background:var(--cream);color:var(--text);overflow-x:hidden;}

        /* NAVBAR */
        .navbar-custom{background:var(--red);padding:0 2rem;height:64px;display:flex;align-items:center;justify-content:space-between;position:sticky;top:0;z-index:1000;box-shadow:0 3px 16px rgba(0,0,0,.25);}
        .navbar-brand-txt{color:#fff;font-weight:800;font-size:1.35rem;display:flex;align-items:center;gap:.5rem;text-decoration:none;}
        .navbar-brand-txt img{height:38px;width:38px;border-radius:50%;object-fit:cover;border:2px solid rgba(255,255,255,.5);}
        .nav-links{display:flex;align-items:center;gap:.25rem;}
        .nav-links a{color:rgba(255,255,255,.88);font-size:.82rem;font-weight:500;padding:.35rem .75rem;border-radius:6px;text-decoration:none;transition:background .18s,color .18s;}
        .nav-links a:hover{background:rgba(255,255,255,.18);color:#fff;}
        .nav-right{display:flex;align-items:center;gap:.75rem;}
        .nav-greeting{color:rgba(255,255,255,.85);font-size:.82rem;font-weight:500;}
        .btn-logout{background:rgba(255,255,255,.15);color:#fff;border:1.5px solid rgba(255,255,255,.4);padding:.3rem .9rem;border-radius:20px;font-size:.8rem;font-weight:600;text-decoration:none;transition:background .18s;}
        .btn-logout:hover{background:rgba(255,255,255,.28);color:#fff;}

        /* MARQUEE */
        .marquee-bar{background:linear-gradient(90deg,var(--orange),var(--red));color:#fff;font-size:.78rem;font-weight:600;padding:.35rem 0;letter-spacing:.03em;}

        /* HERO */
        .hero{position:relative;overflow:hidden;background:linear-gradient(135deg,#1C1008 0%,#3B1A0A 60%,#5C2A10 100%);min-height:420px;display:flex;align-items:center;}
        .hero-bg-img{position:absolute;right:0;top:0;height:100%;width:55%;object-fit:cover;opacity:.55;mask-image:linear-gradient(to left,rgba(0,0,0,.9) 60%,transparent 100%);-webkit-mask-image:linear-gradient(to left,rgba(0,0,0,.9) 60%,transparent 100%);}
        .hero-content{position:relative;z-index:2;padding:3.5rem 5%;animation:fadeUp .7s ease both;}
        .hero-content h1{font-family:'Playfair Display',serif;font-size:clamp(2rem,4vw,3.2rem);color:#fff;line-height:1.18;margin-bottom:.75rem;}
        .hero-content p{color:rgba(255,255,255,.72);font-size:.95rem;margin-bottom:1.5rem;}
        .btn-hero{display:inline-flex;align-items:center;gap:.5rem;background:var(--red);color:#fff;font-weight:700;font-size:.9rem;padding:.7rem 1.6rem;border-radius:30px;text-decoration:none;box-shadow:0 4px 18px rgba(217,59,43,.55);transition:transform .18s,box-shadow .18s,background .18s;}
        .btn-hero:hover{background:var(--red2);color:#fff;transform:translateY(-2px);box-shadow:0 8px 24px rgba(217,59,43,.5);}

        /* CATEGORY PILLS */
        .category-row{display:flex;gap:.65rem;overflow-x:auto;padding:1.4rem 4% .6rem;scrollbar-width:none;}
        .category-row::-webkit-scrollbar{display:none;}
        .cat-pill{display:flex;align-items:center;gap:.4rem;white-space:nowrap;background:#fff;border:1.5px solid #EEE3D8;border-radius:24px;padding:.38rem .95rem;font-size:.8rem;font-weight:600;color:var(--text);cursor:pointer;transition:border-color .18s,background .18s,transform .15s;box-shadow:0 2px 8px rgba(0,0,0,.06);}
        .cat-pill:hover,.cat-pill.active{border-color:var(--red);background:var(--red);color:#fff;transform:scale(1.04);}
        .cat-pill span{font-size:1rem;}

        /* SECTION HEADERS */
        .section-head{display:flex;align-items:center;justify-content:space-between;padding:.8rem 4% .5rem;}
        .section-head h2{font-size:1.15rem;font-weight:700;}
        .section-head a{color:var(--red);font-size:.8rem;font-weight:600;text-decoration:none;}

        /* OUTLET CARDS */
        .outlets-row{display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:1.1rem;padding:.5rem 4% 1.5rem;}
        .outlet-card{background:var(--card-bg);border-radius:16px;overflow:hidden;box-shadow:var(--shadow);transition:transform .22s,box-shadow .22s;animation:fadeUp .5s ease both;}
        .outlet-card:hover{transform:translateY(-5px);box-shadow:0 18px 40px rgba(180,50,30,.18);}
        .outlet-card img{width:100%;height:180px;object-fit:cover;display:block;}
        .outlet-info{padding:.9rem 1rem 1rem;}
        .outlet-info h5{font-size:.95rem;font-weight:700;margin-bottom:.25rem;}
        .outlet-meta{display:flex;align-items:center;gap:.4rem;font-size:.75rem;color:var(--muted);margin-bottom:.75rem;}
        .outlet-meta .star{color:#f5a623;font-size:.8rem;}
        .btn-view-menu{width:100%;background:var(--green);color:#fff;border:none;padding:.45rem;border-radius:8px;font-size:.8rem;font-weight:700;cursor:pointer;transition:background .18s,transform .15s;}
        .btn-view-menu:hover{background:#1b5e20;transform:scale(1.02);}
        .btn-closed{background:#c62828 !important;cursor:not-allowed;}

        /* outlets fade-in animation for new cards */
        @keyframes slideIn{from{opacity:0;transform:translateY(18px);}to{opacity:1;transform:translateY(0);}}
        .outlet-card.new{animation:slideIn .35s ease both;}

        /* MENU SECTION */
        .menu-header-bar{display:flex;align-items:center;justify-content:space-between;background:linear-gradient(90deg,var(--red),var(--orange));padding:.85rem 4%;margin:.5rem 4% 0;border-radius:14px 14px 0 0;}
        .menu-header-bar h2{color:#fff;font-size:1.1rem;font-weight:700;}
        .menu-header-bar .btn-excel,.menu-header-bar .btn-pdf{background:rgba(255,255,255,.18);color:#fff;border:1.5px solid rgba(255,255,255,.4);padding:.32rem .85rem;border-radius:20px;font-size:.75rem;font-weight:600;text-decoration:none;margin-left:.4rem;transition:background .18s;}
        .menu-header-bar .btn-excel:hover,.menu-header-bar .btn-pdf:hover{background:rgba(255,255,255,.32);color:#fff;}

        /* 4-column menu grid */
        .menu-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:1.1rem;padding:1rem 4% 2rem;}
        @media(max-width:1024px){.menu-grid{grid-template-columns:repeat(3,1fr);}}
        @media(max-width:768px){.menu-grid{grid-template-columns:repeat(2,1fr);}}

        .menu-card{background:var(--card-bg);border-radius:16px;overflow:hidden;box-shadow:var(--shadow);transition:transform .22s,box-shadow .22s;animation:fadeUp .5s ease both;}
        .menu-card:hover{transform:translateY(-5px) scale(1.01);box-shadow:0 18px 40px rgba(180,50,30,.2);}
        .menu-card img{width:100%;height:210px;object-fit:cover;display:block;}
        .menu-card-body{padding:.85rem 1rem .95rem;}
        .menu-card-body h5{font-size:.92rem;font-weight:700;margin-bottom:.15rem;}
        .menu-card-body .outlet-tag{font-size:.73rem;color:var(--muted);margin-bottom:.5rem;}
        .menu-card-body .price{font-size:.9rem;font-weight:800;color:var(--red);}
        .btn-details{width:100%;margin-top:.55rem;background:transparent;border:2px solid var(--red);color:var(--red);border-radius:8px;padding:.38rem;font-size:.78rem;font-weight:700;cursor:pointer;transition:background .18s,color .18s,transform .15s;}
        .btn-details:hover{background:var(--red);color:#fff;transform:scale(1.02);}

        /* PROMO BANNER */
        .promo-banner{margin:.5rem 4% 1.5rem;background:linear-gradient(120deg,#FFF3E0,#FFE0B2);border:2px dashed var(--orange);border-radius:14px;padding:1.1rem 1.8rem;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:.75rem;}
        .promo-banner p{font-size:1rem;font-weight:600;color:var(--text);}
        .promo-banner p span{color:var(--red);font-size:1.3rem;font-weight:800;}
        .btn-order-now{background:var(--red);color:#fff;padding:.5rem 1.3rem;border-radius:24px;font-weight:700;font-size:.85rem;text-decoration:none;transition:background .18s,transform .15s;white-space:nowrap;}
        .btn-order-now:hover{background:var(--red2);color:#fff;transform:scale(1.04);}

        /* HOW IT WORKS */
        .how-section{padding:1.5rem 4% 2rem;text-align:center;}
        .how-section h2{font-size:1.2rem;font-weight:700;margin-bottom:1.4rem;}
        .how-steps{display:flex;justify-content:center;gap:2.5rem;flex-wrap:wrap;}
        .how-step{display:flex;flex-direction:column;align-items:center;gap:.55rem;max-width:140px;}
        .how-step .circle{width:72px;height:72px;border-radius:50%;background:#fff;box-shadow:0 4px 18px rgba(0,0,0,.1);display:flex;align-items:center;justify-content:center;font-size:1.8rem;transition:transform .22s;}
        .how-step:hover .circle{transform:scale(1.1) rotate(-5deg);}
        .how-step .num{background:var(--red);color:#fff;border-radius:50%;width:22px;height:22px;font-size:.72rem;font-weight:800;display:flex;align-items:center;justify-content:center;margin-top:-.4rem;}
        .how-step p{font-size:.8rem;font-weight:600;color:var(--text);}

        /* =========================
   PARTNERSHIP CAROUSEL
========================= */

.partner-section{
    padding:2rem 0 4rem;
    background:var(--cream);
    overflow:hidden;
    position:relative;
}

.partner-heading{
    text-align:center;
    font-size:1.3rem;
    font-weight:800;
    margin-bottom:1.8rem;
    color:var(--text);
}

.partner-heading span{
    color:var(--red);
}

.partner-wrapper{
    width:100%;
    overflow:hidden;
    position:relative;
}

.partner-track{
    display:flex;
    gap:1.5rem;
    width:max-content;
    animation:scrollPartners 28s linear infinite;
}

.partner-wrapper:hover .partner-track{
    animation-play-state:paused;
}

.partner-card{
    min-width:340px;
    max-width:340px;
    background:linear-gradient(145deg,#fff,#fff7f2);
    border-radius:22px;
    overflow:hidden;
    box-shadow:0 12px 35px rgba(0,0,0,.10);
    transition:.4s ease;
    cursor:pointer;
    border:1px solid rgba(217,59,43,.08);
}

.partner-card:hover{
    transform:scale(1.08);
    box-shadow:0 18px 40px rgba(217,59,43,.22);
}

.partner-card img{
    width:100%;
    height:240px;
    object-fit:contain;
    display:block;
    padding:1.5rem;
    background:linear-gradient(145deg,#fff,#fff7f2);
}

.partner-info{
padding:1.2rem 1.2rem 1.4rem;
}

.partner-info h4{
   font-size:1.15rem;
    font-weight:800;
    margin-bottom:.55rem;
    color:var(--text);
}

.partner-info p{
    font-size:.86rem;
    line-height:1.7;
    color:var(--muted);
    margin:0;
}

/* animation */

@keyframes scrollPartners{
    0%{
        transform:translateX(0);
    }

    100%{
        transform:translateX(-50%);
    }
}

/* gradient blur sides */

.partner-wrapper::before,
.partner-wrapper::after{
    content:'';
    position:absolute;
    top:0;
    width:120px;
    height:100%;
    z-index:5;
    pointer-events:none;
}

.partner-wrapper::before{
    left:0;
    background:linear-gradient(to right,var(--cream),transparent);
}

.partner-wrapper::after{
    right:0;
    background:linear-gradient(to left,var(--cream),transparent);
}

@media(max-width:768px){

    .partner-card{
        min-width:280px;
        max-width:280px;
    }

    .partner-card img{
        height:190px;
    }
}

        /* FOOTER */
        footer{background:var(--dark);color:rgba(255,255,255,.7);padding:1.1rem 4%;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:.75rem;font-size:.78rem;}
        footer a{color:rgba(255,255,255,.7);text-decoration:none;margin:0 .5rem;}
        footer a:hover{color:#fff;}
        .social-icons{display:flex;gap:.6rem;}
        .social-icons a{width:32px;height:32px;background:rgba(255,255,255,.12);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:.85rem;transition:background .18s,transform .15s;}
        .social-icons a:hover{background:var(--red);transform:scale(1.1);}

        /* MODAL OVERLAY */
        .modal-overlay{position:fixed;inset:0;z-index:9999;background:rgba(28,16,8,.65);backdrop-filter:blur(8px);display:flex;align-items:center;justify-content:center;opacity:0;pointer-events:none;transition:opacity .28s ease;}
        .modal-overlay.open{opacity:1;pointer-events:all;}
        .modal-card{background:#fff;border-radius:20px;overflow:hidden;max-width:440px;width:92%;position:relative;box-shadow:0 24px 60px rgba(0,0,0,.35);transform:scale(.88) translateY(30px);transition:transform .3s cubic-bezier(.34,1.56,.64,1);}
        .modal-overlay.open .modal-card{transform:scale(1) translateY(0);}
        .modal-card img{width:100%;height:220px;object-fit:cover;display:block;}
        .modal-body{padding:1.4rem 1.5rem 1.6rem;}
        .modal-body h4{font-size:1.15rem;font-weight:800;margin-bottom:.25rem;}
        .modal-body .modal-tag{font-size:.78rem;color:var(--muted);margin-bottom:.6rem;}
        .modal-body .modal-desc{font-size:.85rem;color:#555;line-height:1.6;margin-bottom:.85rem;}
        .modal-body .modal-price{font-size:1.3rem;font-weight:800;color:var(--red);}
        .modal-body .modal-meta{display:flex;gap:1rem;font-size:.78rem;color:var(--muted);margin-top:.4rem;}
        .btn-close-modal{position:absolute;top:.75rem;right:.75rem;width:32px;height:32px;border-radius:50%;background:rgba(0,0,0,.12);border:none;cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:1rem;color:#333;transition:background .18s,transform .15s;}
        .btn-close-modal:hover{background:var(--red);color:#fff;transform:rotate(90deg);}
        .btn-add-cart{width:100%;margin-top:1rem;background:var(--red);color:#fff;border:none;border-radius:10px;padding:.65rem;font-size:.9rem;font-weight:700;cursor:pointer;transition:background .18s,transform .15s;}
        .btn-add-cart:hover{background:var(--red2);transform:scale(1.02);}


        /* ── NEWSLETTER ── */
        .newsletter-section{background:linear-gradient(135deg,#2D1A0E 0%,#1C1008 100%);padding:3rem 4%;}
        .newsletter-section .nl-heading{font-size:1.3rem;font-weight:800;color:#fff;margin-bottom:.4rem;}
        .newsletter-section .nl-sub{color:var(--orange);font-size:.85rem;line-height:1.5;}
        .newsletter-section .nl-label{color:#7EC8D4;font-size:.72rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;margin-bottom:.6rem;}
        .nl-form{display:flex;gap:.6rem;flex-wrap:wrap;}
        .nl-form input[type=email]{flex:1;min-width:200px;padding:.55rem 1rem;border-radius:8px;border:1.5px solid rgba(255,255,255,.2);background:rgba(255,255,255,.08);color:#fff;font-size:.85rem;outline:none;transition:border .18s;}
        .nl-form input[type=email]::placeholder{color:rgba(255,255,255,.45);}
        .nl-form input[type=email]:focus{border-color:var(--orange);}
        .nl-form button{background:var(--red);color:#fff;border:none;padding:.55rem 1.4rem;border-radius:8px;font-weight:700;font-size:.85rem;cursor:pointer;transition:background .18s,transform .15s;white-space:nowrap;}
        .nl-form button:hover{background:var(--red2);transform:scale(1.03);}
        .nl-divider{border:none;border-top:1px solid rgba(255,255,255,.08);margin:0;}

        /* ── FOOTER MAIN ── */
        .footer-main{background:#130C04;padding:2.5rem 4% 1.5rem;}
        .footer-main h5{color:#fff;font-weight:700;font-size:.9rem;margin-bottom:1rem;position:relative;padding-bottom:.5rem;}
        .footer-main h5::after{content:'';position:absolute;left:0;bottom:0;width:28px;height:2px;background:var(--red);border-radius:2px;}
        .footer-main ul{list-style:none;padding:0;margin:0;}
        .footer-main ul li{margin-bottom:.4rem;}
        .footer-main ul li a{color:rgba(255,255,255,.5);text-decoration:none;font-size:.82rem;transition:color .18s,padding-left .18s;}
        .footer-main ul li a:hover{color:var(--orange);padding-left:4px;}
        .footer-about p{color:var(--red);font-size:.82rem;line-height:1.6;margin-top:.25rem;}

        /* ── FOOTER BOTTOM BAR ── */
        .footer-bar{background:#0D0804;padding:.75rem 4%;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:.5rem;}
        .footer-bar p{color:rgba(255,255,255,.38);font-size:.74rem;margin:0;}
        .footer-bar .policy-links a{color:rgba(255,255,255,.4);font-size:.74rem;text-decoration:none;margin-left:1rem;}
        .footer-bar .policy-links a:hover{color:var(--orange);}
        .footer-social{display:flex;gap:.5rem;}
        .footer-social a{width:30px;height:30px;background:rgba(255,255,255,.08);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:.8rem;color:rgba(255,255,255,.55);transition:background .18s,color .18s,transform .15s;}
        .footer-social a:hover{background:var(--red);color:#fff;transform:scale(1.1);}

        @media(max-width:768px){
            .nl-left{margin-bottom:1.5rem;}
            .footer-main .row > div{margin-bottom:1.5rem;}
        }

        @keyframes fadeUp{from{opacity:0;transform:translateY(22px);}to{opacity:1;transform:translateY(0);}}

        @media(max-width:640px){
            .nav-links{display:none;}
            .outlets-row{grid-template-columns:1fr 1fr;}
            .how-steps{gap:1.2rem;}
        }
    </style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar-custom">
    <a class="navbar-brand-txt" href="home.php">
        <img src="https://www.shutterstock.com/image-vector/festivasl-food-court-hall-logo-260nw-2233823755.jpg" alt="logo"/>
        Food Plaza
    </a>
    <div class="nav-links">
        <a href="home.php">Home</a>
        <a href="admin.php">Dashboard</a>
        <a href="menu.php">Products</a>
        <a href="fooddetail.php">Details</a>
        <a href="gallery.php">Gallery</a>
        <a href="about.html">About</a>
        <a href="contact.html">Contact</a>
    </div>
    <div class="nav-right">
        <span class="nav-greeting">👋 Hello, <?= $_SESSION["uname"] ?? 'Guest' ?></span>
        <a class="btn-logout" href="logout.php">Logout</a>
    </div>
</nav>

<!-- MARQUEE -->
<div class="marquee-bar">
    <marquee>🎉 Welcome to Food Plaza — Order from your table, No waiting! &nbsp;&nbsp;&nbsp; 🧿 Fresh food, Fast delivery &nbsp;&nbsp;&nbsp; 🎆 Buy 1 Get 1 on selected items today!</marquee>
</div>

<!-- HERO -->
<section class="hero">
    <img class="hero-bg-img" src="https://img.freepik.com/free-psd/flat-design-food-template_23-2150063838.jpg?w=740" alt="food"/>
    <div class="hero-content">
        <h1>Order from your<br/>favourite food outlets</h1>
        <p>No waiting. Order directly from your table.</p>
        <a href="menu.php" class="btn-hero">Browse Outlets &nbsp;›</a>
    </div>
</section>

<!-- CATEGORIES -->
<div class="category-row">
    <div class="cat-pill active" data-cat="pizza"><span>🍕</span> Pizza</div>
    <div class="cat-pill" data-cat="burgers"><span>🍔</span> Burgers</div>
    <div class="cat-pill" data-cat="indian"><span>🍛</span> Indian</div>
    <div class="cat-pill" data-cat="beverages"><span>🥤</span> Beverages</div>
    <div class="cat-pill" data-cat="chinese"><span>🥟</span> Chinese</div>
    <div class="cat-pill" data-cat="desserts"><span>🍰</span> Desserts</div>
    <div class="cat-pill" data-cat="street"><span>🌮</span> Street Food</div>
    <div class="cat-pill" data-cat="healthy"><span>🥗</span> Healthy</div>
</div>

<!-- OUTLETS (dynamically rendered by JS) -->
<div class="section-head mt-2">
    <h2 id="outletsTitle">🍕 Pizza Outlets</h2>
    <a href="menu.php">View all ›</a>
</div>
<div class="outlets-row" id="outletsContainer"></div>

<!-- PROMO BANNER -->
<div class="promo-banner">
    <p>Flat <span>10% OFF</span> on orders above ₹299! 🎊</p>
    <a href="#" class="btn-order-now">Order Now ›</a>
</div>

<!-- MENU CARD SECTION -->
<div class="menu-header-bar">
    <h2>🍽️ Menu Card</h2>
    <div>
        <a href="excel.php" class="btn-excel"><i class="fas fa-file-excel"></i> Excel</a>
        <a href="pdf.php" class="btn-pdf"><i class="fas fa-file-pdf"></i> PDF</a>
    </div>
</div>

<div class="menu-grid">

    <?php
    $staticMenu = [
        [
            "name"        => "Margherita Pizza",
            "outlet"      => "Pizza Corner",
            "outlet_icon" => "🍕",
            "price"       => "200",
            "image"       => "uploads/margherita_pizza.jpeg",
            "description" => "A classic Italian pizza topped with fresh tomato sauce, creamy mozzarella, and fragrant basil leaves. Baked to golden perfection in our stone oven.",
            "tags"        => "Veg · 350 kcal · 25 mins"
        ],
        [
            "name"        => "Veg Burger",
            "outlet"      => "Burger Hub",
            "outlet_icon" => "🍔",
            "price"       => "120",
            "image"       => "uploads/veg_burger.jpeg",
            "description" => "A hearty veggie patty stacked with crisp lettuce, tomato, cheese, and our signature sauce. Served in a toasted sesame bun.",
            "tags"        => "Veg · 420 kcal · 15 mins"
        ],
        [
            "name"        => "Paneer Pizza",
            "outlet"      => "Pizza Corner",
            "outlet_icon" => "🍕",
            "price"       => "250",
            "image"       => "uploads/paneer_pizza.jpeg",
            "description" => "Tender paneer cubes marinated in tandoori spices on a rich tomato base with bell peppers and onions.",
            "tags"        => "Veg · 480 kcal · 30 mins"
        ],
        [
            "name"        => "Veg Momos",
            "outlet"      => "Momos Express",
            "outlet_icon" => "🥟",
            "price"       => "100",
            "image"       => "uploads/veg_momos.jpeg",
            "description" => "Steamed dumplings stuffed with spiced cabbage, carrots, and spring onions. Served with fiery red chutney.",
            "tags"        => "Veg · 220 kcal · 20 mins"
        ],
        [
            "name"        => "Masala Dosa",
            "outlet"      => "South Indian Treats",
            "outlet_icon" => "🥘",
            "price"       => "120",
            "image"       => "uploads/masala_dosa.jpeg",
            "description" => "Golden crispy rice crepe filled with spiced potato masala. Served with coconut chutney and piping hot sambar.",
            "tags"        => "Veg · 310 kcal · 20 mins"
        ],
        [
            "name"        => "Idli Sambar",
            "outlet"      => "South Indian Treats",
            "outlet_icon" => "🥘",
            "price"       => "90",
            "image"       => "uploads/idli_sambar.jpeg",
            "description" => "Soft steamed rice cakes served with tangy lentil sambar and fresh coconut chutney. A wholesome South Indian breakfast.",
            "tags"        => "Veg · 250 kcal · 15 mins"
        ],
        [
            "name"        => "Paneer Butter Masala",
            "outlet"      => "Punjabi Dhaba",
            "outlet_icon" => "🍛",
            "price"       => "220",
            "image"       => "uploads/paneer_butter_masala.jpeg",
            "description" => "Rich, creamy tomato-based curry with soft paneer cubes. Cooked in a traditional Punjabi style. Best paired with naan.",
            "tags"        => "Veg · 520 kcal · 30 mins"
        ]
    ];

    foreach ($staticMenu as $item):
        $outletDisplay = $item['outlet_icon'] . ' ' . $item['outlet'];
    ?>
    <div class="menu-card">
        <img src="<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>"/>
        <div class="menu-card-body">
            <h5><?= htmlspecialchars($item['name']) ?></h5>
            <p class="outlet-tag"><?= htmlspecialchars($outletDisplay) ?></p>
            <div class="price">&#8377; <?= htmlspecialchars($item['price']) ?></div>
            <button class="btn-details" onclick='openModal(
                <?= json_encode($item["name"]) ?>,
                <?= json_encode($outletDisplay) ?>,
                <?= json_encode("₹ " . $item["price"]) ?>,
                <?= json_encode($item["image"]) ?>,
                <?= json_encode($item["description"]) ?>,
                <?= json_encode($item["tags"]) ?>
            )'>Details</button>
        </div>
    </div>
    <?php endforeach; ?>

    <?php if ($result && $result->num_rows > 0): while ($row = $result->fetch_assoc()): ?>
    <div class="menu-card">
        <img src="<?= htmlspecialchars($row['image'] ?? '') ?>" alt="<?= htmlspecialchars($row['name']) ?>"/>
        <div class="menu-card-body">
            <h5><?= htmlspecialchars($row['name']) ?></h5>
            <p class="outlet-tag"><?= htmlspecialchars($row['outlet'] ?? '') ?></p>
            <div class="price">&#8377; <?= htmlspecialchars($row['price']) ?></div>
            <button class="btn-details" onclick='openModal(
                <?= json_encode($row["name"]) ?>,
                <?= json_encode($row["outlet"] ?? "") ?>,
                <?= json_encode("₹ " . $row["price"]) ?>,
                <?= json_encode($row["image"] ?? "") ?>,
                <?= json_encode($row["description"] ?? "Delicious food item prepared fresh daily.") ?>,
                <?= json_encode($row["tags"] ?? "") ?>
            )'>Details</button>
        </div>
    </div>
    <?php endwhile; endif; ?>

</div>


<!-- HOW IT WORKS -->
<div class="how-section">
    <h2>How It Works</h2>
    <div class="how-steps">
        <div class="how-step">
            <div class="circle">📷</div>
            <div class="num">1</div>
            <p>Scan QR Code</p>
        </div>
        <div class="how-step">
            <div class="circle">📋</div>
            <div class="num">2</div>
            <p>Order from Menu</p>
        </div>
        <div class="how-step">
            <div class="circle">🍽️</div>
            <div class="num">3</div>
            <p>Enjoy Your Food</p>
        </div>
    </div>
</div>



<!-- PARTNERSHIP CAROUSEL -->

<section class="partner-section">

    <h2 class="partner-heading">
        🍔 Our Restaurant <span>Partners</span>
    </h2>

    <div class="partner-wrapper">

        <div class="partner-track">

            <!-- CARD 1 -->
            <div class="partner-card">
                <img src="uploads/mcd.png" alt="">
                <div class="partner-info">
                    <h4>McDonald's</h4>
                    <p>
                        Enjoy world famous burgers, fries and refreshing combos from McDonald's.
                    </p>
                </div>
            </div>

            <!-- CARD 2 -->
            <div class="partner-card">
                <img src="uploads/kfc.png" alt="">
                <div class="partner-info">
                    <h4>KFC</h4>
                    <p>
                        Crispy fried chicken buckets, burgers and spicy snacks delivered hot.
                    </p>
                </div>
            </div>

            <!-- CARD 3 -->
            <div class="partner-card">
                <img src="uploads/Pizza_hut.png" alt="">
                <div class="partner-info">
                    <h4>Pizza Hut</h4>
                    <p>
                        Fresh cheesy pizzas with premium toppings and delicious sides.
                    </p>
                </div>
            </div>

            <!-- CARD 4 -->
            <div class="partner-card">
                <img src="uploads/dominos.png" alt="">
                <div class="partner-info">
                    <h4>Domino's</h4>
                    <p>
                        Fast pizza delivery with tasty garlic bread and loaded cheese bursts.
                    </p>
                </div>
            </div>

            <!-- CARD 5 -->
            <div class="partner-card">
                <img src="uploads/Starbucks.png" alt="">
                <div class="partner-info">
                    <h4>Starbucks</h4>
                    <p>
                        Premium coffees, frappes and snacks prepared by expert baristas.
                    </p>
                </div>
            </div>

            <!-- CARD 6 -->
            <div class="partner-card">
                <img src="uploads/Subway.png" alt="">
                <div class="partner-info">
                    <h4>Subway</h4>
                    <p>
                        Healthy and delicious sandwiches loaded with fresh veggies and sauces.
                    </p>
                </div>
            </div>

            <!-- DUPLICATE FOR INFINITE EFFECT -->

            <div class="partner-card">
                <img src="uploads/mcd.png" alt="">
                <div class="partner-info">
                    <h4>McDonald's</h4>
                    <p>
                        Enjoy world famous burgers, fries and refreshing combos from McDonald's.
                    </p>
                </div>
            </div>

            <div class="partner-card">
                <img src="uploads/kfc.png" alt="">
                <div class="partner-info">
                    <h4>KFC</h4>
                    <p>
                        Crispy fried chicken buckets, burgers and spicy snacks delivered hot.
                    </p>
                </div>
            </div>

            <div class="partner-card">
                <img src="uploads/Pizza_hut.png" alt="">
                <div class="partner-info">
                    <h4>Pizza Hut</h4>
                    <p>
                        Fresh cheesy pizzas with premium toppings and delicious sides.
                    </p>
                </div>
            </div>

            <div class="partner-card">
                <img src="uploads/dominos.png" alt="">
                <div class="partner-info">
                    <h4>Domino's</h4>
                    <p>
                        Fast pizza delivery with tasty garlic bread and loaded cheese bursts.
                    </p>
                </div>
            </div>

        </div>

    </div>

</section>  


<!-- NEWSLETTER -->
<section class="newsletter-section">
    <div class="row align-items-center" style="max-width:1200px;margin:0 auto;">
        <div class="col-lg-4 nl-left mb-3 mb-lg-0">
            <p class="nl-heading">Get an update every week</p>
            <p class="nl-sub">We ensure your food is delivered in the best quality,<br/>at the right time.</p>
        </div>
        <div class="col-lg-8">
            <p class="nl-label">Subscribe to Newsletter</p>
            <form class="nl-form" onsubmit="handleNewsletter(event)">
                <input type="email" placeholder="Enter your email address" required/>
                <button type="submit">Subscribe</button>
            </form>
        </div>
    </div>
</section>

<hr class="nl-divider"/>

<!-- FOOTER MAIN -->
<div class="footer-main">
    <div class="row" style="max-width:1200px;margin:0 auto;">
        <!-- About -->
        <div class="col-lg-3 col-md-6 footer-about">
            <h5>Food Plaza</h5>
            <p>The most trusted Food Court<br/>company in your area.<br/>Fresh food. Fast delivery.</p>
        </div>
        <!-- Other Links -->
        <div class="col-lg-3 col-md-6">
            <h5>Other Links</h5>
            <ul>
                <li><a href="gallery.html">Blogs &amp; Gallery</a></li>
                <li><a href="#">Movers Website</a></li>
                <li><a href="#">Traffic Update</a></li>
            </ul>
        </div>
        <!-- Services -->
        <div class="col-lg-3 col-md-6">
            <h5>Services</h5>
            <ul>
                <li><a href="#">Corporate Goods</a></li>
                <li><a href="#">Artworks</a></li>
                <li><a href="#">Documents</a></li>
            </ul>
        </div>
        <!-- Customer Care -->
        <div class="col-lg-3 col-md-6">
            <h5>Customer Care</h5>
            <ul>
                <li><a href="about.html">About Us</a></li>
                <li><a href="contact.html">Contact Us</a></li>
                <li><a href="home.php">Get Updates</a></li>
            </ul>
        </div>
    </div>
</div>

<!-- FOOTER BAR -->
<div class="footer-bar">
    <p>&copy; 2025 Food Plaza. All rights reserved.</p>
    <div class="policy-links">
        <a href="#">Terms</a>
        <a href="#">Privacy</a>
        <a href="#">Cookies</a>
    </div>
    <div class="footer-social">
        <a href="#"><i class="fab fa-facebook-f"></i></a>
        <a href="#"><i class="fab fa-twitter"></i></a>
        <a href="#"><i class="fab fa-instagram"></i></a>
    </div>
</div>

<!-- DETAIL MODAL -->
<div class="modal-overlay" id="detailModal" onclick="closeOnBg(event)">
    <div class="modal-card" id="modalCard">
        <button class="btn-close-modal" onclick="closeModal()">✕</button>
        <img id="modalImg" src="" alt=""/>
        <div class="modal-body">
            <h4 id="modalName"></h4>
            <p class="modal-tag" id="modalTag"></p>
            <p class="modal-desc" id="modalDesc"></p>
            <div class="modal-price" id="modalPrice"></div>
            <div class="modal-meta" id="modalMeta"></div>
            <button class="btn-add-cart">🛒 Add to Cart</button>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script>
// ── OUTLET DATA PER CATEGORY ──
const outletData = {
    pizza: [
        { name:'Pizza Express', rating:'4.5', time:'20–25 mins', img:'https://img.freepik.com/free-psd/web-banner-template-japanese-restaurant_23-2148203258.jpg?w=400', open:true },
        { name:'Pizza Corner', rating:'4.7', time:'15–20 mins', img:'https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?w=400', open:true },
        { name:'Stone Oven Pizzeria', rating:'4.4', time:'25–30 mins', img:'https://images.unsplash.com/photo-1594007654729-407eedc4be65?w=400', open:true },
        { name:'Crust & Fire', rating:'4.2', time:'30–35 mins', img:'https://images.unsplash.com/photo-1574071318508-1cdbab80d002?w=400', open:false },
    ],
    burgers: [
        { name:'Burger House', rating:'4.3', time:'15–20 mins', img:'https://img.freepik.com/free-psd/food-menu-restaurant-web-banner-template_106176-1452.jpg', open:true },
        { name:'Burger Hub', rating:'4.1', time:'10–15 mins', img:'https://images.unsplash.com/photo-1550547660-d9450f859349?w=400', open:true },
        { name:'Stack & Smash', rating:'4.5', time:'20–25 mins', img:'https://images.unsplash.com/photo-1568901346375-23c9450c58cd?w=400', open:true },
        { name:'The Patty Lab', rating:'4.0', time:'25–30 mins', img:'https://images.unsplash.com/photo-1553979459-d2229ba7433b?w=400', open:false },
    ],
    indian: [
        { name:'Punjabi Dhaba', rating:'4.6', time:'20–25 mins', img:'https://img.freepik.com/free-vector/flat-design-indian-restaurant-facebook-cover_23-2149447258.jpg?w=400', open:true },
        { name:'Tandoori Delight', rating:'4.7', time:'25–30 mins', img:'https://images.unsplash.com/photo-1585937421612-70a008356fbe?w=400', open:false },
        { name:'South Indian Treats', rating:'4.5', time:'15–20 mins', img:'https://images.unsplash.com/photo-1589301760014-d929f3979dbc?w=400', open:true },
        { name:'Spice Route', rating:'4.3', time:'30–35 mins', img:'https://images.unsplash.com/photo-1567188040759-fb8a883dc6d8?w=400', open:true },
    ],
    beverages: [
        { name:'Juice Junction', rating:'4.4', time:'5–10 mins', img:'https://images.unsplash.com/photo-1622597467836-f3285f2131b8?w=400', open:true },
        { name:'Brew & Sip', rating:'4.2', time:'10–15 mins', img:'https://images.unsplash.com/photo-1544145945-f90425340c7e?w=400', open:true },
        { name:'Shake Shack Bar', rating:'4.5', time:'8–12 mins', img:'https://images.unsplash.com/photo-1570197788417-0e82375c9371?w=400', open:true },
        { name:'Lassi Corner', rating:'4.3', time:'5–10 mins', img:'https://images.unsplash.com/photo-1607013407627-6352b8ec4ad9?w=400', open:false },
    ],
    chinese: [
        { name:'Wok & Roll', rating:'4.2', time:'20–25 mins', img:'https://img.freepik.com/free-vector/flat-design-american-food-twitter-header_23-2149155490.jpg?w=400', open:true },
        { name:'Momos Express', rating:'4.4', time:'15–20 mins', img:'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTeNPCfeAMSxY93MVGV-7-AicFxf3KAuUobhw&s', open:true },
        { name:'Dragon Kitchen', rating:'4.0', time:'25–30 mins', img:'https://images.unsplash.com/photo-1563245372-f21724e3856d?w=400', open:true },
        { name:'Noodle House', rating:'4.3', time:'20–25 mins', img:'https://images.unsplash.com/photo-1557872943-16a5ac26437e?w=400', open:false },
    ],
    desserts: [
        { name:'Sweet Treats', rating:'4.6', time:'10–15 mins', img:'https://images.unsplash.com/photo-1551024506-0bccd828d307?w=400', open:true },
        { name:'Ice Cream Lab', rating:'4.8', time:'5–10 mins', img:'https://images.unsplash.com/photo-1563805042-7684c019e1cb?w=400', open:true },
        { name:'Cake Studio', rating:'4.5', time:'15–20 mins', img:'https://images.unsplash.com/photo-1578985545062-69928b1d9587?w=400', open:true },
        { name:'Kulfi & Co.', rating:'4.3', time:'10–15 mins', img:'https://images.unsplash.com/photo-1557805090-5ab8e7590b09?w=400', open:false },
    ],
    street: [
        { name:'Street Food Junction', rating:'4.4', time:'10–15 mins', img:'https://img.freepik.com/free-psd/delicious-food-restaurant-facebook-template_23-2150291425.jpg?w=400', open:true },
        { name:'Chaat Bazaar', rating:'4.5', time:'8–12 mins', img:'https://images.unsplash.com/photo-1606755962773-d324e0a13086?w=400', open:true },
        { name:'Pani Puri Palace', rating:'4.3', time:'5–10 mins', img:'https://images.unsplash.com/photo-1630383249896-205c07f58371?w=400', open:false },
        { name:'Bhel Express', rating:'4.1', time:'5–8 mins', img:'https://images.unsplash.com/photo-1599487488170-d11ec9c172f0?w=400', open:true },
    ],
    healthy: [
        { name:'Green Bowl', rating:'4.7', time:'15–20 mins', img:'https://images.unsplash.com/photo-1512621776951-a57141f2eefd?w=400', open:true },
        { name:'Fresh & Fit', rating:'4.5', time:'10–15 mins', img:'https://images.unsplash.com/photo-1540420773420-3366772f4999?w=400', open:true },
        { name:'Sprout Kitchen', rating:'4.3', time:'20–25 mins', img:'https://images.unsplash.com/photo-1490645935967-10de6ba17061?w=400', open:true },
        { name:'Protein Pit', rating:'4.2', time:'15–20 mins', img:'https://images.unsplash.com/photo-1547592180-85f173990554?w=400', open:false },
    ],
};

const catLabels = {
    pizza:'🍕 Pizza Outlets', burgers:'🍔 Burger Outlets', indian:'🍛 Indian Outlets',
    beverages:'🥤 Beverage Outlets', chinese:'🥟 Chinese Outlets', desserts:'🍰 Dessert Outlets',
    street:'🌮 Street Food Outlets', healthy:'🥗 Healthy Outlets'
};

function renderOutlets(cat) {
    const container = document.getElementById('outletsContainer');
    const title = document.getElementById('outletsTitle');
    title.textContent = catLabels[cat] || 'Popular Outlets';
    const outlets = outletData[cat] || [];

    container.innerHTML = outlets.map(o => `
        <div class="outlet-card new">
            <img src="${o.img}" alt="${o.name}" onerror="this.src='https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?w=400'"/>
            <div class="outlet-info">
                <h5>${o.name}</h5>
                <div class="outlet-meta"><i class="fas fa-star star"></i> ${o.rating} &nbsp;·&nbsp; ${o.time}</div>
                <button class="btn-view-menu${o.open ? '' : ' btn-closed'}" ${o.open ? '' : 'disabled'}>${o.open ? 'View Menu ›' : 'Closed'}</button>
            </div>
        </div>
    `).join('');

    // re-trigger animation by forcing reflow
    container.querySelectorAll('.outlet-card').forEach((card, i) => {
        card.style.animationDelay = (i * 0.07) + 's';
    });
}

// CATEGORY PILL CLICK
document.querySelectorAll('.cat-pill').forEach(pill => {
    pill.addEventListener('click', () => {
        document.querySelectorAll('.cat-pill').forEach(p => p.classList.remove('active'));
        pill.classList.add('active');
        renderOutlets(pill.dataset.cat);
    });
});

// Initial render
renderOutlets('pizza');

// MODAL
function openModal(name, outlet, price, img, desc, meta) {
    document.getElementById('modalName').textContent = name;
    document.getElementById('modalTag').textContent = '🏪 ' + outlet;
    document.getElementById('modalDesc').textContent = desc;
    document.getElementById('modalPrice').textContent = price;
    document.getElementById('modalMeta').textContent = meta;
    document.getElementById('modalImg').src = img;
    document.getElementById('detailModal').classList.add('open');
    document.body.style.overflow = 'hidden';
}
function closeModal() {
    document.getElementById('detailModal').classList.remove('open');
    document.body.style.overflow = '';
}
function closeOnBg(e) {
    if (e.target === document.getElementById('detailModal')) closeModal();
}
document.addEventListener('keydown', e => { if (e.key === 'Escape') closeModal(); });
// NEWSLETTER
function handleNewsletter(e) {
    e.preventDefault();
    const btn = e.target.querySelector('button');
    const input = e.target.querySelector('input');
    btn.textContent = '✓ Subscribed!';
    btn.style.background = '#2E7D32';
    input.value = '';
    setTimeout(() => { btn.textContent = 'Subscribe'; btn.style.background = ''; }, 3000);
}

</script>
</body>
</html>