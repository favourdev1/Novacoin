<div class="relative">
    <div class="gemini-rings__container gemini-onscreen h-[70vh] w-[70vh] absolute top-0 left-[45%]  flex items-center justify-center" >
        <div class="gemini-small-ring w-[70vh] h-[70vh] ">
            <svg viewBox="0 0 1035 1035" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle opacity="0.7" cx="517.705" cy="517.696" r="516.686" transform="rotate(180 517.705 517.696)"
                    stroke="url(#paint0_linear_14378_921)" stroke-width="0.924967" stroke-linecap="round"></circle>
                <circle cx="844.605" cy="916.606" r="7.65157" fill="url(#paint1_radial_14378_921)"></circle>
                <circle opacity="0.45" cx="844.606" cy="916.606" r="30.6063" fill="url(#paint2_radial_14378_921)">
                </circle>
                <defs>
                    <linearGradient id="paint0_linear_14378_921" x1="289.558" y1="-56.5064" x2="793.783"
                        y2="977.345" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#A8BFFF"></stop>
                        <stop offset="0.185" stop-color="#A8BFFF" stop-opacity="0"></stop>
                        <stop offset="0.385" stop-color="#A8BFFF"></stop>
                        <stop offset="0.575" stop-color="#A8BFFF" stop-opacity="0"></stop>
                        <stop offset="0.79" stop-color="#A8BFFF" stop-opacity="0.5"></stop>
                        <stop offset="1" stop-color="#A8BFFF" stop-opacity="0"></stop>
                    </linearGradient>
                    <radialGradient id="paint1_radial_14378_921" cx="0" cy="0" r="1"
                        gradientUnits="userSpaceOnUse"
                        gradientTransform="translate(840.459 911.823) rotate(47.5638) scale(15.1157 71.1088)">
                        <stop stop-color="#456EFF"></stop>
                        <stop offset="0.5" stop-color="#4FABFF"></stop>
                        <stop offset="1" stop-color="#B1C5FF"></stop>
                    </radialGradient>
                    <radialGradient id="paint2_radial_14378_921" cx="0" cy="0" r="1"
                        gradientUnits="userSpaceOnUse"
                        gradientTransform="translate(843.467 917.139) rotate(104.973) scale(31.1309)">
                        <stop stop-color="#4FABFF"></stop>
                        <stop offset="0.575" stop-color="#4866B5" stop-opacity="0.2"></stop>
                        <stop offset="1" stop-color="white" stop-opacity="0"></stop>
                    </radialGradient>
                </defs>
            </svg>
        </div>
        <div class="gemini-large-ring w-[70vh] h-[70vh] absolute top-0 left-[45%]">
            <svg viewBox="0 0 1185 1185" fill="none" xmlns="http://www.w3.org/2000/svg">
                <ellipse opacity="0.7" cx="592.59" cy="592.321" rx="591.321" ry="591.32"
                    transform="rotate(90 592.59 592.321)" stroke="url(#paint0_linear_14378_915)" stroke-width="0.924967"
                    stroke-linecap="round"></ellipse>
                <circle cx="117.26" cy="242.261" r="12.7526" fill="url(#paint1_radial_14378_915)"></circle>
                <circle opacity="0.45" cx="117.261" cy="242.261" r="55.2613" fill="url(#paint2_radial_14378_915)">
                </circle>
                <defs>
                    <linearGradient id="paint0_linear_14378_915" x1="331.487" y1="-64.8241" x2="908.546"
                        y2="1118.37" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#A8BFFF"></stop>
                        <stop offset="0.2" stop-color="#A8BFFF" stop-opacity="0"></stop>
                        <stop offset="0.395" stop-color="#A8BFFF"></stop>
                        <stop offset="0.6" stop-color="#A8BFFF" stop-opacity="0"></stop>
                        <stop offset="0.8" stop-color="#A8BFFF"></stop>
                        <stop offset="1" stop-color="#A8BFFF" stop-opacity="0"></stop>
                    </linearGradient>
                    <radialGradient id="paint1_radial_14378_915" cx="0" cy="0" r="1"
                        gradientUnits="userSpaceOnUse"
                        gradientTransform="translate(110.351 234.289) rotate(47.5638) scale(25.1928 118.515)">
                        <stop stop-color="#456EFF"></stop>
                        <stop offset="0.5" stop-color="#4FABFF"></stop>
                        <stop offset="1" stop-color="#B1C5FF"></stop>
                    </radialGradient>
                    <radialGradient id="paint2_radial_14378_915" cx="0" cy="0" r="1"
                        gradientUnits="userSpaceOnUse"
                        gradientTransform="translate(115.205 243.222) rotate(104.973) scale(56.2086)">
                        <stop stop-color="#4FABFF"></stop>
                        <stop offset="0.575" stop-color="#4866B5" stop-opacity="0.2"></stop>
                        <stop offset="1" stop-color="white" stop-opacity="0"></stop>
                    </radialGradient>
                </defs>
            </svg>
        </div>
    </div>
</div>


<style>
  

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    @keyframes spinClockwise {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }

    }

    .gemini-small-ring {
        animation: spin 12s linear infinite;
    }

    .gemini-large-ring {
        animation: spinClockwise 12s linear infinite;
    }

    .gemini-animated-rings-element .gemini-onscreen .gemini-small-ring {
        transform: scale(1);
    }

  
</style>
