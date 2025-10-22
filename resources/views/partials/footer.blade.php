<!-- resources/views/partials/footer.blade.php -->
<footer class="bg-slate-50 dark:bg-slate-900 border-t dark:border-slate-800 text-slate-700 dark:text-slate-300">
  <div class="container mx-auto px-4 md:px-6 lg:px-8 py-12">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
      <!-- About / Logo -->
      <div>
        <a href="{{ url('/') }}" class="flex items-center gap-3 mb-4">
          <img src="/images/logo-dark.svg" alt="متجرنا" class="h-10 dark:hidden" />
          <img src="/images/logo-light.svg" alt="متجرنا" class="h-10 hidden dark:block" />
        </a>
        <p class="text-sm text-slate-600 dark:text-slate-400">متجر إلكتروني مبتكر — تجربة تسوق حديثة وسلسة. اشترِ الآن واستفد من العروض الخاصة.</p>

        <div class="mt-4 flex items-center gap-3">
          <!-- social icons -->
          <a href="#" class="p-2 rounded-md hover:bg-slate-100 dark:hover:bg-slate-800"><svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 2h4v4"></path></svg></a>
          <a href="#" class="p-2 rounded-md hover:bg-slate-100 dark:hover:bg-slate-800"><svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M22 12a10 10 0 11-20 0 10 10 0 0120 0z"></path></svg></a>
        </div>
      </div>

      <!-- Quick links -->
      <div>
        <h4 class="font-semibold mb-3">روابط سريعة</h4>
        <ul class="space-y-2 text-sm">
          <li><a href="#" class="hover:underline">طرق الشحن</a></li>
          <li><a href="#" class="hover:underline">سياسة الإرجاع</a></li>
          <li><a href="#" class="hover:underline">الأسئلة الشائعة</a></li>
          <li><a href="#" class="hover:underline">اتصل بنا</a></li>
        </ul>
      </div>

      <!-- Newsletter -->
      <div class="md:col-span-1">
        <h4 class="font-semibold mb-3">اشترك في النشرة</h4>
        <p class="text-sm text-slate-600 dark:text-slate-400 mb-3">احصل على خصم 10% لأول طلب عند الاشتراك</p>
        <form action="#" method="POST" class="flex gap-2">
          @csrf
          <input name="email" type="email" placeholder="بريدك الإلكتروني" required class="flex-1 rounded-lg border border-slate-200 dark:border-slate-700 py-2 px-3 bg-white dark:bg-slate-800" />
          <button class="px-4 py-2 rounded-lg bg-primary text-white">اشترك</button>
        </form>
      </div>

      <!-- Payments & Contact -->
      <div>
        <h4 class="font-semibold mb-3">طرق الدفع & تواصل</h4>
        <div class="flex gap-2 items-center mb-3">
          <img src="/images/pay-visa.svg" alt="visa" class="h-8" />
          <img src="/images/pay-master.svg" alt="master" class="h-8" />
          <img src="/images/pay-apple.svg" alt="apple" class="h-8" />
        </div>
        <p class="text-sm">هاتف: <a href="tel:+201234567890" class="hover:underline">+20 123 456 7890</a></p>
        <p class="text-sm">بريد: <a href="mailto:info@store.com" class="hover:underline">info@store.com</a></p>
      </div>
    </div>

    <div class="mt-8 border-t pt-6 text-sm text-slate-500 dark:text-slate-400 flex flex-col md:flex-row items-center justify-between gap-4">
      <p>© {{ date('Y') }} متجرنا. جميع الحقوق محفوظة.</p>
      <div class="flex items-center gap-4">
        <a href="#" class="hover:underline">شروط الاستخدام</a>
        <a href="#" class="hover:underline">سياسة الخصوصية</a>
      </div>
    </div>
  </div>
</footer>


<!-- Simple JS to handle dark mode, mobile menu and cart drawer -->
<script>
  // Dark mode toggle (RTL-friendly) - call this in your Blade layout before </body>
  (function(){
    const html = document.documentElement;
    const toggle = document.getElementById('darkToggle');
    const moon = document.getElementById('moonIcon');
    const sun = document.getElementById('sunIcon');

    function setDark(isDark){
      if(isDark){
        html.classList.add('dark');
        localStorage.setItem('theme','dark');
        moon.classList.remove('hidden'); sun.classList.add('hidden');
        toggle.setAttribute('aria-pressed','true');
      } else {
        html.classList.remove('dark');
        localStorage.setItem('theme','light');
        sun.classList.remove('hidden'); moon.classList.add('hidden');
        toggle.setAttribute('aria-pressed','false');
      }
    }

    // init theme
    const stored = localStorage.getItem('theme');
    if(stored) setDark(stored === 'dark');
    else setDark(window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches);

    if(toggle){
      toggle.addEventListener('click', ()=> setDark(!document.documentElement.classList.contains('dark')));
    }

    // Mobile menu
    const mobileBtn = document.getElementById('mobileMenuBtn');
    const mobileMenu = document.getElementById('mobileMenu');
    if(mobileBtn && mobileMenu){
      mobileBtn.addEventListener('click', ()=> mobileMenu.classList.toggle('hidden'));
    }

    // Cart drawer
    const cartBtn = document.getElementById('cartBtn');
    const cartDrawer = document.getElementById('cartDrawer');
    const cartBackdrop = document.getElementById('cartBackdrop');
    const closeCart = document.getElementById('closeCart');
    function openCart(){
      cartDrawer.querySelector('aside').classList.remove('translate-x-full');
      cartBackdrop.classList.add('opacity-100');
    }
    function hideCart(){
      cartDrawer.querySelector('aside').classList.add('translate-x-full');
      cartBackdrop.classList.remove('opacity-100');
    }
    if(cartBtn){ cartBtn.addEventListener('click', openCart); }
    if(closeCart){ closeCart.addEventListener('click', hideCart); }
    if(cartBackdrop){ cartBackdrop.addEventListener('click', hideCart); }

  })();
</script>

<!-- Notes:
 - Replace image paths with your assets.
 - Add Tailwind "primary" color via theme (e.g., --tw-prose-invert or custom color class .bg-primary in tailwind.config.js)
 - For accessibility & better interactivity, integrate Alpine.js or small Vue components for dropdowns and dynamic cart content.
 - To support RTL properly, ensure html dir="rtl" or use conditional direction based on locale: <html dir="rtl"> for Arabic.
-->
