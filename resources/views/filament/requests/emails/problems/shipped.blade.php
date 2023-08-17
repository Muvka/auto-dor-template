<x-mail::panel>
	<x-mail::table>
		<x-tables::row>
			<x-tables::cell>
				Адрес
			</x-tables::cell>
			<x-tables::cell>
				{{ $problemAddress }}
			</x-tables::cell>
		</x-tables::row>
		<x-tables::row>
			<x-tables::cell>
				Комментарий
			</x-tables::cell>
			<x-tables::cell>
				{{ $problemComment }}
			</x-tables::cell>
		</x-tables::row>
		<x-tables::row>
			<x-tables::cell>
				Номер телефона
			</x-tables::cell>
			<x-tables::cell>
				{{ $problemTelephone }}
			</x-tables::cell>
		</x-tables::row>
	</x-mail::table>
</x-mail::panel>
