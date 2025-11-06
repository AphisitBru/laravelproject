<footer class="bg-primary text-white py-4 mt-5">
    <div class="container">
        @if(request()->is('calculator'))
        <div class="row" id="answer-section">
            <div class="col-md-12">
                <h4 class="mb-3">ผลลัพธ์: <span id="answer" class="text-warning">0</span></h4>
            </div>
        </div>
        @endif
        <!-- <div class="row">
            <div class="col-md-12 text-center">
                <p class="mb-0">&copy; 2025 All rights reserved.</p>
            </div>
        </div> -->
    </div>
</footer>

