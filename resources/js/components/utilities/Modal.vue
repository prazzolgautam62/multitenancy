<script setup>

</script>

<template>
  <div
    class="modal fade show d-block"
    id="largeModal"
    tabindex="-1"
    role="dialog"
    style="padding-right:15px;"
  >
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <slot name="header"></slot>
        </div>
        <div class="modal-body" style="max-height:70vh; overflow-y:auto;">
          <slot name="body"></slot>
        </div>
        <div class="modal-footer">
          <slot name="save"></slot>
          <slot name="close">
            <button @click="$emit('close')" type="button" class="btn btn-danger waves-effect" data-dismiss="modal">CLOSE</button>
          </slot>
        </div>
      </div>
    </div>
  </div>
</template>