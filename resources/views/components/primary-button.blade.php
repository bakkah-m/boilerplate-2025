<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-soft']) }}>
    {{ $slot }}
</button>
