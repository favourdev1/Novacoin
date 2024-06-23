<div
id="disapproveModal" 
    class="relative z-10 "
    style="display: none"
    aria-labelledby="modal-title"
    role="dialog"
    aria-modal="true"
>
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
            <!--
        Modal panel, show/hide based on modal state.

        Entering: "ease-out duration-300"
          From: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
          To: "opacity-100 translate-y-0 sm:scale-100"
        Leaving: "ease-in duration-200"
          From: "opacity-100 translate-y-0 sm:scale-100"
          To: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
      -->
            <div
                class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                    <div class=" w-full items-start">
                      
                        <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                            <h3
                                class="text-base font-semibold leading-6 text-gray-900"
                                id="modal-title"
                            >Decline Withdrawal Reason</h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">Enter a mesage 🗨 to be sent to the user for the reason
                                    why this mail is not approved </p>
                                <div>
                                    {{--  --}}
                                    <div class="flex flex-col ">

                                        <label for="reason" class="text-gray-500">Reason for disapproval:</label>
                                        <textarea class="text-gray-500 border border-[#eeeeee] rounded-lg"
                                        id="reason"
                                        name="reason"
                                        ></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                    <button
                           id="submitDisapproval"

                        type="button"
                        class="inline-flex w-full justify-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 sm:ml-3 sm:w-auto"
                    >Send</button>
                    <button
                                  id="cancelDisapproval"
                        type="button"
                        class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto"
                    >Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>