<x-dynamic-component :component="$getFieldWrapperView()" :field="$field">
    <input wire:model="{{ $getStatePath() }}" />
</x-dynamic-component>