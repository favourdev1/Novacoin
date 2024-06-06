@props(['id', 'show' => false])

<div  id={{$id}}  x-show="showModal" x-data="{ show: @json($show) }"  class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <!--
      Background backdrop, show/hide based on modal state.
  
      Entering: "ease-out duration-300"
        From: "opacity-0"
        To: "opacity-100"
      Leaving: "ease-in duration-200"
        From: "opacity-100"
        To: "opacity-0"
    -->
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
        
            <div
                class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                    <div class="flex  flex-col justify-center items-center">
                        <div
                            class="mx-autoitems-center justify-center rounded-full bg-red-100 ">
                            <img src="{{$image}}" alt="Invest Image ">
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:text-left">
                            <h3 class=" font-black text-xl text-gray-900 text-center" id="modal-title">{{$title}}</h3>
                            <div class="mt-2">
                                <p id="descriptionModal" class="text-base text-center text-gray-500">{{$description}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3  mb-5">
                    <button type="button" @click="$dispatch('confirm-investment')"
                        class="inline-flex w-full justify-center rounded-full bg-gray-900 px-3 py-3 text-sm font-semibold text-white shadow-sm hover:bg-gray-950  ">{{$buttonText}}</button>
                        <button type="button" @click="showModal = false" 
                        class="inline-flex w-full justify-center rounded-full bg-white px-3 py-3 text-sm font-semibold text-gray-900 focus:border-none  hover:bg-gray-100 border mt-5  ">Cancel</button>
                  
                </div>
            </div>
        </div>
    </div>
</div>
