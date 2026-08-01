@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-slate-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm text-sm px-3 py-2 w-full', 'style' => 'border: 1px solid #cbd5e1; border-radius: 8px; padding: 8px 12px; font-family: "Inter", sans-serif; outline: none;']) }}>
