@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
    <h1>Mozdalif Sikder</h1>
@if (trim($slot) === 'Laravel')

@else
{{ $slot }}
@endif
</a>
</td>
</tr>
