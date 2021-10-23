<template>
  <button @click="count++, $emit('counter', count)"> {{count}}</button>
</template>

<script>
export default {
    name: 'Button-counter',
data: function () {
    return {
      count: 0
    }
  },
}
</script>

<style>

</style>