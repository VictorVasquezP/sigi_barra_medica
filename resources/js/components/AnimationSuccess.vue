<template>
    <div class="msg-success text-center">
        <div class="ui-success" id="ui-success">
            <svg viewBox="0 0 87 87" version="1.1" xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink">
                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <g id="Group-3" transform="translate(2.000000, 2.000000)">
                        <circle id="Oval-2" stroke="rgba(165, 220, 134, 0.2)" stroke-width="4" cx="41.5" cy="41.5"
                            r="41.5">
                        </circle>
                        <circle class="ui-success-circle" id="Oval-2" stroke="#A5DC86" stroke-width="4" cx="41.5"
                            cy="41.5" r="41.5"></circle>
                        <polyline class="ui-success-path" id="Path-2" stroke="#A5DC86" stroke-width="4"
                            points="19 38.8036813 31.1020744 54.8046875 63.299221 28"></polyline>
                    </g>
                </g>
            </svg>
        </div>
        <h3>Solicitud enviada con éxito</h3>
    </div>
</template>
<script>
export default {
    
};
</script>
<style>
.ui-success {
    width: 100px;
    height: 100px;
    margin: 20px auto;
}
.ui-success-circle {
    stroke-dasharray: 260.75219025px, 260.75219025px;
    stroke-dashoffset: 260.75219025px;
    transform: rotate(220deg);
    transform-origin: center center;
    stroke-linecap: round;
    animation: ani-success-circle 1s ease-in both;
}
.ui-success-path {
    stroke-dasharray: 60px 64px;
    stroke-dashoffset: 62px;
    stroke-linecap: round;
    animation: ani-success-path 0.4s 1s ease-in both;
}
@keyframes ani-success-circle {
    to {
        stroke-dashoffset: 782.25657074px;
    }
}
@keyframes ani-success-path {
    0% {
        stroke-dashoffset: 62px;
    }
    65% {
        stroke-dashoffset: -5px;
    }
    84% {
        stroke-dashoffset: 4px;
    }
    100% {
        stroke-dashoffset: -2px;
    }
}
</style>