<div class="relative bg-gradient-to-b from-gray-700 gray-800 to-black">
  
    <div class="mx-auto flex max-w-[90rem] gap-2 px-4 py-2 hidden"></div>
    {{-- <hr class="border-neutral-800"> --}}
    <div
        class="mx-auto flex max-w-[90rem] justify-center py-12 text-black text-white md:justify-center pl-[max(env(safe-area-inset-left),1.5rem)] pr-[max(env(safe-area-inset-right),1.5rem)]">
        <div aria-labelledby="footer-heading" class="w-full">
            <h2 class="sr-only" id="footer-heading">Footer</h2>
            <div class="mx-auto w-full py-8">
                <div class="xl:grid xl:grid-cols-3 xl:gap-8">
                    <div class="grid grid-cols-1 gap-8 xl:col-span-2">
                        <div class="grid grid-cols-2 sm:grid-c
                        ols-3 md:grid-cols-3 md:gap-8">
                            <div class="mt-12 md:!mt-0">
                                <h3 class="text-sm text-black text-white">Resources</h3>
                                <ul class="ml-0 mt-4 list-none space-y-1.5">
                                    <li><a class="text-sm  text-[#888888] no-underline betterhover:hover:text-gray-700 betterhover:hover:text-white transition"
                                            href="/blog">Home</a></li>
                                    <li><a class="text-sm  text-[#888888] no-underline betterhover:hover:text-gray-700 betterhover:hover:text-white transition"
                                            href="#features">Features</a></li>
                                    <li><a class="text-sm  text-[#888888] no-underline betterhover:hover:text-gray-700 betterhover:hover:text-white transition"
                                            href="/governance">Governance</a></li>
                                </ul>
                            </div>
                           
                         
                            <div class="mt-12 md:!mt-0">
                                <h3 class="text-sm text-black text-white">Company</h3>
                                <ul class="ml-0 mt-4 list-none space-y-1.5">
                                    <li><a class="text-sm  text-[#888888] no-underline betterhover:hover:text-gray-700 betterhover:hover:text-white transition"
                                            href="#">About Us</a></li>
                                    <li><a class="text-sm  text-[#888888] no-underline betterhover:hover:text-gray-700 betterhover:hover:text-white transition"
                                            href="terms">Terms and Condition</a></li>
                                    <li><a class="text-sm  text-[#888888] no-underline betterhover:hover:text-gray-700 betterhover:hover:text-white transition"
                                            href="/privacyPolicy">Privacy Policy</a></li>
                                    <li><a class="text-sm  text-[#888888] no-underline betterhover:hover:text-gray-700 betterhover:hover:text-white transition"
                                            href="/contact">Contact Us</a></li>
                                </ul>
                            </div>
                         
                            {{-- <div class="mt-12 md:!mt-0">
                                <h3 class="text-sm text-black text-white">Support</h3>
                                <ul class="ml-0 mt-4 list-none space-y-1.5">
                                    <li><a class="text-sm  text-[#888888] no-underline betterhover:hover:text-gray-700 betterhover:hover:text-white transition"
                                            href="https://github.com/vercel/turbo">GitHub</a></li>
                                    <li><a class="text-sm  text-[#888888] no-underline betterhover:hover:text-gray-700 betterhover:hover:text-white transition"
                                            href="https://turbo.build/discord">Discord</a></li>
                                </ul>
                            </div> --}}
                        </div>
                    </div>
                    <div class="mt-12 xl:!mt-0">
                        <h3 class="text-sm text-black text-white">Subscribe to our newsletter</h3>
                        <p class="mt-4 text-sm text-gray-600 text-[#888888]">Subscribe to the Turbo newsletter and
                            stay updated on new releases and features, guides, and case studies.</p>
                        <form class="mt-4 sm:flex sm:max-w-md"><label class="sr-only" for="email-address">Email
                                address</label><input autocomplete="email"
                                class="w-full min-w-0 appearance-none rounded-md border border-[#666666] bg-white px-4 py-2 text-base text-gray-900 placeholder-gray-500 focus:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-800 border-[#888888] bg-transparent text-white focus:border-white sm:text-sm"
                                id="email-address" placeholder="you@example.com" required="" type="email"
                                name="email-address" value="">
                            <div class="mt-3 rounded-md sm:ml-3 sm:mt-0 sm:flex-shrink-0"><button
                                    class="betterhover:hover:bg-gray-600 betterhover:hover:bg-gray-300 flex w-full items-center justify-center rounded-md border border-transparent bg-blue-700 px-4 py-2 text-base font-medium text-white focus:outline-none focus:ring-2 focus:ring-gray-800 text-black focus:ring-white sm:text-sm"
                                    type="submit">Subscribe</button></div>
                        </form>
                    </div>
                </div>
                <div class="mt-8 pt-8 sm:flex sm:items-center sm:justify-between">
                    <div> <div class="flex items-center font-black gap-4">
                        <x-authentication-card-logo :width="'50'" />
                        {{ config('app.name') }}
                    </div>
                        <p class="mt-4 text-xs text-gray-500 text-[#888888]">© <!-- -->2020<!-- -->           {{ config('app.name') }}, Inc.
                            All rights reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Smartsupp Live Chat script -->
<script type="text/javascript">
    var _smartsupp = _smartsupp || {};
    _smartsupp.key = 'f6d09fad2f383ad6e1c0405f741bbd4d3f89d83d';
    window.smartsupp||(function(d) {
      var s,c,o=smartsupp=function(){ o._.push(arguments)};o._=[];
      s=d.getElementsByTagName('script')[0];c=d.createElement('script');
      c.type='text/javascript';c.charset='utf-8';c.async=true;
      c.src='https://www.smartsuppchat.com/loader.js?';s.parentNode.insertBefore(c,s);
    })(document);
    </script>
    {{-- <noscript> Powered by <a href=“https://www.smartsupp.com” target=“_blank”>Smartsupp</a></noscript> --}}