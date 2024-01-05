<script setup>
</script>

<template>
    <div class="h-full w-full overflow-hidden" id="guest-layout">

        <div class="background-overlay"></div>

        <div class="logo-container">
            <img src="https://upload.wikimedia.org/wikipedia/commons/7/7a/Logonetflix.png" alt="Netflix Logo" style="height: 60px; width: auto;">
        </div>
    <slot name="log" />
  </div>
</template>

<style scoped>
    #guest-layout {
        position: relative;
        margin: 0;
        background-image: url('https://assets.nflxext.com/ffe/siteui/vlv3/ca6a7616-0acb-4bc5-be25-c4deef0419a7/5e37ba12-c915-458f-8215-9e73c4961cbc/PH-en-20231211-popsignuptwoweeks-perspective_alpha_website_small.jpg');
    }

    .background-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
  }

  .logo-container {
    position: absolute;
    top: 20px;
    left: 20px;
    z-index: 1;
  }
</style>
