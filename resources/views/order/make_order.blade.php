@extends('/layouts/main')

@push('css-dependencies')
<link rel="stylesheet" type="text/css" href="/css/order.css" />
@endpush

@push('scripts-dependencies')
<script src="/js/make_order.js"></script>
<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
@endpush

@push('modals-dependencies')
@include('/partials/order/transfer_instructions_modal')
@endpush

@section('content')
<div class="container-fluid px-2 px-lg-4">
  <h1 class="main-title">
    {{ $title }}
  </h1>
  <div class="row">

    <!-- Left -->
    <div class="col-12 col-lg-9">
      <div class="accordion" id="accordionMain">

        <!-- top field -->
        <div class="accordion-item mb-3 px-4 py-3">
          <form action="/order/make_order/{{ $product->id }}" method="post">
            @csrf

            <!-- hidden input -->
            <input type="hidden" name="product_id" value="{{ old('product_id', $product->id) }}">

            <div class="row mb-3">
              <div class="col-md-8">
                <div class="form-group">
                  <label for="product_name">Product Name</label>
                  <input id="product_name" name="product_name" value="{{ $product->product_name }}" type="text"
                    class="form-control" disabled>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="price">Price per pieces</label>
                  @if ($product->discount == 0)
                  <input type="hidden" id="price" name="price" data-truePrice="{{ old('price', $product->price) }}"
                    value="Rp.
                {{ old('price', $product->price) }}" type="text" class="form-control" disabled>
                  @else
                  <input type="hidden" id="price" name="price"
                    data-truePrice="{{ old('price', ((100 - $product->discount)/100) * $product->price) }}"
                    value="Rp. {{ old('price', ((100 - $product->discount)/100) *$product->price) }}" type="text"
                    class="form-control" disabled>
                  @endif
                  <div class="input-group" style="display:unset;">
                    <div class="input-group-prepend">
                      @if ($product->discount == 0)
                      <span class="input-group-text">
                        {{ $product->price }}
                      </span>
                      @else
                      <span class="input-group-text">Rp. {{ ((100 - $product->discount)/100) * $product->price }} <span
                          class="strikethrough ms-4">
                          {{ $product->price }}
                        </span><sup><sub class="mx-1">of</sub>
                          {{ $product->discount }}%
                        </sup>
                      </span>
                      @endif
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group col-2">
              <label for="quantity">Quantity</label>
              <input id="quantity" name="quantity" data-productId="{{ $product->id }}"
                value="{{ old('quantity', '0' ) }}" type="number" min="0"
                class="form-control @error('quantity') is-invalid @enderror" onchange="myCounter()">
            </div>
            <div class="mb-3 col-12">
              @error('quantity')
              <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
            <div class="row mb-3">
    <div class="col-12">Destination</div>
    
    <!-- Province Dropdown -->
    <div class="form-group col-7">
        <select class="form-control @error('province') is-invalid @enderror" id="province" name="province">
            <option value="Purnia" selected="selected">Purnia</option>
        </select>
        @error('province')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    
    <!-- City Dropdown -->
    <div class="form-group col-5">
        <select class="form-control @error('city') is-invalid @enderror" id="city" name="city">
            <option value="Ramkola" selected="selected">Ramkola</option>
        </select>
        @error('city')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>

            <div class="form-group mb-3">
              <label for="address">Address Detail</label>
              <input type="hidden" name="shipping_address" id="shipping_address" value="{{ old('address', auth()->user()->address) }}">
              <input id="address" name="address" type="text" class="form-control @error('address') is-invalid @enderror"
                value="{{ old('address', auth()->user()->address) }}">
              @error('address')
              <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
        </div>

        <!-- Online Banking -->
        <div class="accordion-item mb-3 ">
          <h2 class="h5 px-4 py-3 accordion-header d-flex justify-content-between align-items-center">
            <div class="form-check w-100 collapsed">
              <input class="form-check-input" type="radio" name="payment_method" id="online_bank"
                data-bs-toggle="collapse" data-bs-target="#collapseCC" aria-expanded="false" value="1" {{
                old('payment_method')=='1' ? 'checked' : '' }} onclick="hideMessage('bank')">
              <label class="form-check-label pt-1" for="online_bank" data-bs-toggle="collapse"
                data-bs-target="#collapseCC" aria-expanded="false" onclick="hideMessage('bank')">
                Transfer Bank
              </label>
              @error('payment_method')
              <div class="text-danger" id="bank_alert">{{ $message }}</div>
              @enderror
            </div>
            <span>
              <img src="{{ asset('storage/icons/online-banking.png') }}" height="50px" alt="logo online banking">
            </span>
          </h2>
          <div id="collapseCC" class="accordion-collapse collapse {{ old('payment_method')==1 ? 'show' : '' }}"
            data-bs-parent="#accordionMain">
            <div class="accordion-body">
              <div>Select Bank:</div>
              <div id="mandiri" class="form-check w-100 collapsed">
                <span><img src="{{ asset('storage/icons/bank-mandiri.png') }}" alt="mandiri logo" width="40px"></span>
                <input type="radio" id="bank_mandiri" class="bank" name="bank_id" value="1" {{ old('bank_id')=='1'
                  ? 'checked' : '' }} style="appearance: none;">
                <label for="bank_mandiri" class="colapse_pilih_bank" data-bs-toggle="collapse"
                  data-bs-target="#section_mandiri" aria-expanded="false" style="cursor: pointer;"
                  onclick="hideBankMessage()">ICICI</label>
                <div id="section_mandiri" class="accordion-collapse collapse collapse-pilih-bank"
                  data-bs-parent="#collapseCC">
                  <!-- collapse pilih bank -->
                  <div class="divider"></div>
                  <div class="d-flex justify-content-between">
                    <small class="rek-title">Account Number: </small>
                    <small class="rek-title">Account Holder Name: </small>
                  </div>
                  <div class="d-flex justify-content-between mt-1">
                    <small class="no-rek">092 7840 1923 7422</small>
                    <small class="salin-rek">Manshi Kumari</small>
                  </div>
                  <div class="divider"></div>
                  <small class="note">Will be checked within 10 minutes after successful payment</small>
                </div>
              </div>
              <div id="bri" class="form-check w-100 collapsed">
                <span><img src="{{ asset('storage/icons/SBI.webp') }}" alt="bri logo" width="40px"
                    height="20px"></span>
                <input type="radio" id="bank_bri" class="bank" name="bank_id" value="2" {{ old('bank_id')=='2'
                  ? 'checked' : '' }} style="appearance: none;">
                <label for="bank_bri" class="colapse_pilih_bank" data-bs-toggle="collapse" data-bs-target="#section_bri"
                  aria-expanded="false" style="cursor: pointer;" onclick="hideBankMessage()">State Bank Of India</label>
                <div id="section_bri" class="accordion-collapse collapse fade collapse-pilih-bank"
                  data-bs-parent="#collapseCC">
                  <!-- collapse pilih bank -->
                  <div class="divider"></div>
                  <div class="d-flex justify-content-between">
                    <small class="rek-title">Account Number: </small>
                    <small class="rek-title">Account Holder Name: </small>
                  </div>
                  <div class="rek-content d-flex justify-content-between mt-1">
                    <small class="no-rek">058 9092 8274 9125</small>
                    <small class="salin-rek">Manshi Kumari</small>
                  </div>
                  <div class="divider"></div>
                  <small class="note">Will be checked within 10 minutes after successful payment</small>
                </div>
              </div>
              <div id="bca" class="form-check w-100 collapsed">
                <span><img src="{{ asset('storage/icons/hdfc.png') }}" alt="bca logo" width="40px"></span>
                <input type="radio" id="bank_bca" class="bank" name="bank_id" value="3" {{ old('bank_id')=='3'
                  ? 'checked' : '' }} style="appearance: none;">
                <label for="bank_bca" class="colapse_pilih_bank" data-bs-toggle="collapse" data-bs-target="#section_bca"
                  aria-expanded="false" style="cursor: pointer;" onclick="hideBankMessage()">HDFC</label>
                <div id="section_bca" class="accordion-collapse collapse fade collapse-pilih-bank"
                  data-bs-parent="#collapseCC">
                  <!-- collapse pilih bank -->
                  <div class="divider"></div>
                  <div class="d-flex justify-content-between">
                    <small class="rek-title">Account Number: </small>
                    <small class="rek-title">AAccount Holder Name: </small>
                  </div>
                  <div class="rek-content d-flex justify-content-between mt-1">
                    <small class="no-rek">088 7182 4291 9123</small>
                    <small class="salin-rek">Manshi Kumari</small>
                  </div>
                  <div class="divider"></div>
                  <small class="note">Will be checked within 10 minutes after successful payment</small>
                </div>
              </div>
              <div id="bni" class="form-check w-100 collapsed">
                <span><img src="{{ asset('storage/icons/idfc.jpg') }}" alt="bni logo" width="40px"></span>
                <input type="radio" id="bank_bni" class="bank" name="bank_id" value="4" {{ old('bank_id')=='4'
                  ? 'checked' : '' }} style="appearance: none;">
                <label for="bank_bni" class="colapse_pilih_bank" data-bs-toggle="collapse" data-bs-target="#section_bni"
                  aria-expanded="false" style="cursor: pointer;" onclick="hideBankMessage()">IDFC</label>
                <div id="section_bni" class="accordion-collapse collapse fade collapse-pilih-bank"
                  data-bs-parent="#collapseCC">
                  <!-- collapse pilih bank -->
                  <div class="divider"></div>
                  <div class="d-flex justify-content-between">
                    <small class="rek-title">Account Number: </small>
                    <small class="rek-title">Account Holder Name: </small>
                  </div>
                  <div class="rek-content d-flex justify-content-between mt-1">
                    <small class="no-rek">098 2937 9823 2341</small>
                    <small class="salin-rek">Manshi Kumari</small>
                  </div>
                  <div class="divider"></div>
                  <small class="note">Will be checked within 10 minutes after successful payment</small>
                </div>
              </div>
              @error('bank_id')
              <div class="text-danger mt-3" id="bank_id_alert">{{ $message }}</div>
              @enderror

              <!-- petunjuk -->
              <div class="container mt-3" id="container-petunjuk">
                <div class="mt-4">
                  <h6>Transfer Instructions</h6>
                  <p class="text-muted">SBI Bank Virtual Accounts only accept transfers from SBI Bank accounts. For
                    payments with a SBI account, use a SBI virtual account. The following are transfer instructions if
                    you use State Bank Of India.</p>
                </div>
                <div class="d-flex justify-content-end">
                  <!-- <a class="btn btn-info px-1 py-0" href="#TransferInstructionsModal" data-bs-toggle="modal">See
                    More</a> -->
                </div>
              </div>
            </div>
          </div>
        </div>
        {{-- COD --}}
        <div class="accordion-item mb-3 border">
          <h2 class="h5 px-4 py-3 accordion-header d-flex justify-content-between align-items-center">
            <div class="form-check w-100 collapsed">
              <input class="form-check-input" type="radio" name="payment_method" id="cod" data-bs-toggle="collapse"
                data-bs-target="#collapsePP" aria-expanded="false" value="2" {{ old('payment_method')=='2' ? 'checked'
                : '' }} onclick="hideMessage('cod')">
              <label class="form-check-label pt-1" for="cod" data-bs-toggle="collapse" data-bs-target="#collapsePP"
                aria-expanded="false" onclick="hideMessage('cod')">
                Cash on Delivery
              </label>
              @error('payment_method')
              <div class="text-danger" id="cod_alert">{{ $message }}</div>
              @enderror
            </div>
            <span>
              <img src="{{ asset('storage/icons/cash-on-delivery.png') }}" height="50px" alt="logo COD" />
            </span>
          </h2>
          <div id="collapsePP" class="accordion-collapse collapse  {{ old('payment_method')==2 ? 'show' : '' }}"
            data-bs-parent="#accordionMain">
            <div class="accordion-body">
              <div class="content-cod">
                <div class="note-cod">Note: use this method if you want to do COD transactions</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Right -->
    <div class="col-12 col-lg-3">
      <div class="card position-sticky top-0">
        <div class="p-3 bg-light bg-opacity-10">
          <h6 class="card-title mb-3">Order Summary</h6>
          {{-- loading --}}
          <div id="loading_transaction" style="display: none">
            <lottie-player src="https://assets8.lottiefiles.com/packages/lf20_raiw2hpe.json" background="transparent"
              speed="1" style="width: auto; height: 125px;" loop autoplay>
            </lottie-player>
          </div>
          {{-- transaction resume --}}
          <div id="transaction">
            <div class="d-flex justify-content-between mb-1 small">
              <span>Subtotal</span> <span><span>Rp. </span> <span id="sub-total">0</span></span>
            </div>
            <div class="d-flex justify-content-between mb-1 small">
              <span>Delivery</span><span>
                <span>Rp. </span><span id="shipping" data-shippingCost="0">0</span>
              </span>
            </div>

            <input type="hidden" name="coupon_used" id="coupon_used" value="0">

            <div class="d-flex justify-content-between mb-1 small">
              <span>Coupon
                @if (auth()->user()->coupon == 0)
                (no coupon)
                @else
                <span class="align-items-center">
                  <label for="use_coupon" style="cursor:pointer">(use coupon</label>
                </span>
                <span>
                  <input id="use_coupon" type="checkbox"  onchange="changeStatesCoupon()">
                </span>
                )
                @endif
              </span><span><span></span><span id="coupon" data-valueCoupon="{{ auth()->user()->coupon }}">
                  {{ auth()->user()->coupon }} Coupon
                </span></span>
            </div>
            @if (auth()->user()->coupon != 0)
            <div class="d-flex justify-content-between mb-1 small text-danger">
              <span>Coupon used</span> <span><span id="couponUsedShow">0 coupon</span></span>
            </div>
            @endif
          </div>
          <hr>
          <div class="d-flex justify-content-between mb-4 small">
            <span>TOTAL</span> <strong class="text-dark"><span>Rp. </span><span id="total">0</span></strong>
            <input type="hidden" name="total_price" id="total_price" value="{{ old('total_price', '0') }}">
          </div>
          <div class="form-group small mb-3">
            Make sure you really understand the order you make. If you want to get more information please contact <a
              class="link-danger"
              href="https://wa.me/+918707610243?text=Saya%20ingin%20menanyakan%20detail%20terkait%20produk%20anda"
              target="_blank" style="text-decoration: none;">@admin</a>
          </div>
          <button type="submit" class="btn btn-primary w-100 mt-2">Submit</button>
        </div>
      </div>
      </form>
    </div>
  </div>
</div>
@endsection
@push('scripts-dependencies')
<script>
    // Select the input fields
    const addressInput = document.getElementById('address');
    const shippingAddressInput = document.getElementById('shipping_address');

    // Add an event listener to dynamically update the shipping address
    addressInput.addEventListener('input', function () {
        shippingAddressInput.value = addressInput.value;
    });
</script>
@endpush