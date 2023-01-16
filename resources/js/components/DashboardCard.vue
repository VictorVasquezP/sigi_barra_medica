<template>
    <a :href="url" :target="target" class="dash-card btn-fifth animated-border">
        <i :class="icon"></i>
        <div class="card-line">
            <h3>{{ title }}</h3>
            <h5>{{ info }} {{ textSmall }}</h5>
        </div>
    </a>
</template>

<script>
export default {
    props: {
        color: String,
        title: String,
        icon: String,
        info: Number,
        textSmall: String,
        url: String,
        target: String
    },
    data: function () {
        return {
        }
    },
}
</script>
<style>
.dash-card i {
    font-size: 40px;
    padding: 15px;
    margin: auto;
    border: 1px solid;
    border-radius: 50%;
}
.dash-card {
    box-sizing: border-box;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    background-color: transparent;
    border: 2px solid #07294D;
    cursor: pointer;
    display: flex;
    align-self: center;
    font-size: 1rem;
    line-height: 1;
    margin: auto;
    padding: 1.2em 1.2em;
    text-decoration: none;
    text-align: center;
    text-transform: uppercase;
    font-family: "Montserrat", sans-serif;
    max-width: 350px;
}
.dash-card div {
    flex: 1;
}
.dash-card div h3 {
    font-weight: 800;
    font-size: 22px;
}
.dash-card:hover {
    color: #fff;
    outline: 0;
}
.dash-card:focus {
    color: #07294D;
    outline: 0;
    text-decoration: none;
}
.btn-fifth {
    border-color: #07294D;
    border-radius: 0;
    color: #07294D;
    position: relative;
    overflow: hidden;
    z-index: 1;
    transition: color 150ms ease-in-out;
}
.btn-fifth:after {
    content: "";
    position: absolute;
    display: block;
    top: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 0;
    height: 100%;
    background: #07294D;
    z-index: -1;
    transition: width 300ms ease-in-out;
}
.btn-fifth:hover {
    color: #fff;
}
.btn-fifth:hover:after {
    width: 110%;
}
.animated-border::before,
.animated-border::after {
    position: absolute;
    content: "";
    width: 25px;
    height: 25px;
    transition: all 300ms ease-in-out;
}
.animated-border::before {
    top: -10px;
    left: -10px;
    border-top: 1px solid #fff;
    border-left: 1px solid #fff;
}
.animated-border::after {
    bottom: -10px;
    right: -10px;
    border-bottom: 1px solid #fff;
    border-right: 1px solid #fff;
}
.animated-border:hover::before {
    width: calc(100% + 19px);
    height: calc(100% + 19px);
}
.animated-border:hover::after {
    width: calc(100% + 19px);
    height: calc(100% + 19px);
}
.card-line h5 {
  position: relative;
  display: inline-block;
}
.card-line h5::after, .card-line h5::before {
  content: "";
  position: absolute;
  width: 50px;
  height: 3px;
  background-color: currentcolor;
  top: 55%;
  -webkit-animation: animateLine 1s;
          animation: animateLine 1s;
}
.card-line h5::after {
  left: -60px;
}
.card-line h5::before {
  right: -60px;
}
</style>