@extends('layouts.app')

@section('title', $product->Name)

@section('styles')
<link rel="stylesheet" href="{{ asset('css/products-show.css') }}">
@endsection

@section('content')

<div class="product-container">

    <div class="product-left">
        <div class="img-zoom-container">
            <img id="myimage"
                 src="{{ asset('images/products/' . $product->Image_URL) }}"
                 alt="{{ $product->Name }}"
                 class="product-main-img">
            <!--  DIV for the zoom feature -->
            <div id="myresult" class="img-zoom-result"></div>
        </div>
    </div> 

    <!-- CENTER: Product Details -->
    <div class="product-middle">
        <h1 class="product-title">{{ $product->Name }}</h1>

        <p class="product-description">{{ $product->Description }}</p>

        @php $available = $product->inventory ? (int)$product->inventory->Quantity : 0; @endphp
        <ul class="product-meta">
            <li>✔️ <strong>FREE Returns</strong></li>
            <li>🚚 <strong>Fast Delivery Available</strong></li>
            <li>📦 <strong>{{ $available > 0 ? $available . ' in stock' : 'Out of stock' }}</strong></li>
        </ul>
    </div>

    <!-- RIGHT: Buy Box -->
    <aside class="product-right">
        <div class="buy-box">
            <h2 class="product-price">£{{ number_format($product->Price, 2) }}</h2>

            <form action="{{ route('basket.add', $product->Product_ID) }}" method="POST">
                @csrf
                <label for="qty">Quantity:</label>
                @php $maxQty = min(10, $available); @endphp
                <select name="qty" id="qty" class="qty-select" {{ $available <= 0 ? 'disabled' : '' }}>
                    @for ($i = 1; $i <= $maxQty; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>

                <button type="submit" class="btn-add" {{ $available <= 0 ? 'disabled' : '' }}>{{ $available > 0 ? 'Add to Basket' : 'Out of stock' }}</button>
            </form>

            <div class="extra-info">
                <p><strong>Dispatches from:</strong> OmniCart</p>
                <p><strong>Sold by:</strong> OmniCart</p>
                <p><strong>Secure Transaction</strong> 🔒</p>
            </div>
        </div>

    </aside>

</div>
<!-- IMAGE ZOOM SCRIPT ---JUNAID -->
<script>
 function imageZoom(imgID, resultID) {

  const img = document.getElementById(imgID);
  const result = document.getElementById(resultID);

  if (!img || !result) return;

  const lens = document.createElement("div");
  lens.className = "img-zoom-lens";
  img.parentElement.insertBefore(lens, img);

  let cx, cy;

  function calculateZoom() {
    const rect = img.getBoundingClientRect();

    cx = result.offsetWidth / lens.offsetWidth;
    cy = result.offsetHeight / lens.offsetHeight;

    result.style.backgroundImage = `url('${img.src}')`;
    result.style.backgroundRepeat = "no-repeat";
    result.style.backgroundSize =
      (img.naturalWidth * cx) + "px " +
      (img.naturalHeight * cy) + "px";
  }

  function moveLens(e) {
    e.preventDefault();

    const rect = img.getBoundingClientRect();
    const x = e.clientX - rect.left;
    const y = e.clientY - rect.top;

    let lensX = x - (lens.offsetWidth / 2);
    let lensY = y - (lens.offsetHeight / 2);

    const maxX = img.offsetWidth - lens.offsetWidth;
    const maxY = img.offsetHeight - lens.offsetHeight;

    lensX = Math.max(0, Math.min(lensX, maxX));
    lensY = Math.max(0, Math.min(lensY, maxY));

    lens.style.left = lensX + "px";
    lens.style.top = lensY + "px";

    result.style.backgroundPosition =
      "-" + (lensX * cx) + "px -" +
      (lensY * cy) + "px";
  }

  function showZoom() {
    lens.style.visibility = "visible";
    result.style.visibility = "visible";
    result.style.opacity = "1";
    calculateZoom();
  }

  function hideZoom() {
    lens.style.visibility = "hidden";
    result.style.opacity = "0";
    result.style.visibility = "hidden";
  }

  img.addEventListener("mouseenter", showZoom);
  img.addEventListener("mouseleave", hideZoom);
  lens.addEventListener("mousemove", moveLens);
  img.addEventListener("mousemove", moveLens);
}

document.addEventListener("DOMContentLoaded", function () {
  imageZoom("myimage", "myresult");
});
</script>

{{-- ===================== FEEDBACK SECTION ===================== --}}
<div class="feedback-section">

    <h2>Customer Reviews</h2>

    {{-- ===== Rating Summary ===== --}}
    @php
        $totalReviews = $product->feedbacks->count();
        $average = round($product->feedbacks->avg('Rating'), 1);
        $ratings = $product->feedbacks
            ->groupBy('Rating')
            ->map->count()
            ->toArray();
    @endphp

    <div class="rating-summary">

        <h3>{{ $average ?? 0 }} ⭐ average based on {{ $totalReviews }} reviews</h3>

        @for($i = 5; $i >= 1; $i--)
            @php
                $count = $ratings[$i] ?? 0;
                $percentage = $totalReviews > 0 ? ($count / $totalReviews) * 100 : 0;
            @endphp

            <div class="rating-row">
                <span>{{ $i }} star</span>

                <div class="bar-container">
                    <div class="bar" style="width: {{ $percentage }}%"></div>
                </div>

                <span>{{ $count }}</span>
            </div>
        @endfor

    </div>

    <hr>

    {{-- ===== Review Form ===== --}}
    @auth
    <div class="review-form">
        <h3>Write a Review</h3>

        <form action="{{ route('feedback.store', $product->Product_ID) }}" method="POST">
            @csrf

            <div class="star-rating">
                @for($i = 5; $i >= 1; $i--)
                    <input type="radio" name="rating" value="{{ $i }}" id="star{{ $i }}">
                    <label for="star{{ $i }}">★</label>
                @endfor
            </div>

            <textarea name="review" rows="4" placeholder="Write your review..." required></textarea>

            <button type="submit" class="btn-review">Submit Review</button>
        </form>
    </div>
    @else
        <p>Please login to write a review.</p>
    @endauth

    <hr>

    {{-- ===== Display Reviews ===== --}}
   <div class="all-reviews">

    @forelse($product->feedbacks->sortByDesc('created_at') as $review)
        <div class="review-card">
            <strong>{{ $review->customer->Name ?? 'Anonymous' }}</strong>  {{-- Fixed: customer relationship, Name field --}}

            <div class="review-stars">
                @for($i = 1; $i <= 5; $i++)
                    <span class="{{ $i <= $review->Rating ? 'checked-star' : '' }}">★</span>
                @endfor
            </div>

            <p>{{ $review->Comments }}</p>
            <small>{{ $review->created_at->diffForHumans() }}</small>
        </div>
    @empty
        <p>No reviews yet. Be the first to review this product.</p>
    @endforelse

</div>

</div>
{{-- ===================== END FEEDBACK SECTION ===================== --}}













@endsection
