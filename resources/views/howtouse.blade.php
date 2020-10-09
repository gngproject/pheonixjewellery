@extends('main-layout.template')

@section('content')
<div class="site-section border-bottom" data-aos="fade">
    <div class="container" style="background-color: white">
        <div class="pt-3 mb-5">
            <h2 class="site-section-heading pt-4 mb-4 text-center text-black">Cara Penggunaan Website Phoenix Jewellery</h2>
        </div>
        <div class="row mb-5">
            <div class="col-md-6">
                <p> 1. <a href="/login">Masuk ke akun</a> phoenix jewellery kamu atau <a href="/login">daftar akun</a> phoenix jewellery baru.</p>
                <p>
                    <img src="{{ url('/assets/howtouse/register.png') }}" class="img-fluid rounded"/>
                </p>
            </div>
            <div class="col-md-6">
                <p> 2. Cari dan pilih produk yang kamu inginkan.</p>
                <p>
                    <img src="{{ url('/assets/howtouse/allproduct.png') }}" class="img-fluid rounded"/>
                </p>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-md-6">
                <p>3. Klik “add to chart” untuk langsung melanjutkan ke proses checkout atau klik “Wishlist” jika kamu masih ingin berbelanja nanti.</p>
                <p>
                    <img src="{{ url('/assets/howtouse/add to chart.png') }}" class="img-fluid rounded"/>
                </p>
            </div>
            <div class="col-md-6">
                <p>4. Periksa lagi produk yang kamu beli dalam chart kamu, kemudian klik tombol “Checkout“.</p>
                <p>
                    <img src="{{ url('/assets/howtouse/shoppingcart.png') }}" class="img-fluid rounded"/>
                </p>
            </div>
        </div>
        <div class="pt-3 mb-5">
            <h2 class="site-section-heading pt-4 mb-4 text-black text-center">Pengiriman Barang</h2>
            <h5 class="text-center text-black">Metode Pengiriman</h5>
        </div>
        <div class="row mb-5">
            <div class="col-md-12">
                <p>PhoenixJewellery.id menyediakan layanan pengiriman barang ke seluruh indonesia menggunakan jenis metode pengiriman berikut :</p>
                    <ul style="line-height:200%">
                        <li style="margin-left: 50px;">pengiriman barang melalui jasa logistik partner yaitu RPX.</li>
                        <li style="margin-left: 50px;">Buy Online Pick-up In Store/BOPIS, pengambilan barang langsung ke tempat yang telah ditentukan.</li>
                    </ul>
            </div>
        </div>
        <div class="pt-3 mb-5">
            <h5 class="text-center text-black">Biaya Pengiriman</h5>
        </div>
        <div class="row mb-5">
            <div class="col-md-12">
                <p>menyediakan layanan pengiriman gratis (Free Shipping) ke seluruh Indonesia dengan ketentuan berikut ini:</p>
                    <ul style="line-height:200%">
                        <li style="margin-left: 50px;">pengiriman barang melalui jasa logistik partner yaitu RPX.</li>
                        <li style="margin-left: 50px;">Buy Online Pick-up In Store/BOPIS, pengambilan barang langsung ke tempat yang telah ditentukan.</li>
                    </ul>
            </div>
        </div>
    </div>
</div>
@endsection