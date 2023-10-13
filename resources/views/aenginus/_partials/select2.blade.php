@props([ 'multiple' => false ])

<div{{ $attributes }} wire:ignore x-data="{
    value: @entangle($attributes->wire('model')),
    init(){
        let input = new TomSelect(this.$refs.select, {
            onChange: (value) => this.value = value,
            items: this.value
        });
    }
}">
  <select x-ref="select"{{ $multiple? ' multiple' : '' }} x-model="value">
    {{ $slot }}
  </select>
</div>
