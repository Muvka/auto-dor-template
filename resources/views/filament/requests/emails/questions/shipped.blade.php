<x-mail::panel>
	<x-mail::table>
		<x-tables::row>
			<x-tables::cell>
				Тема обращения
			</x-tables::cell>
			<x-tables::cell>
				{{ $questionSubject }}
			</x-tables::cell>
		</x-tables::row>
		<x-tables::row>
			<x-tables::cell>
				Текст вопроса
			</x-tables::cell>
			<x-tables::cell>
				{{ $questionText }}
			</x-tables::cell>
		</x-tables::row>
		<x-tables::row>
			<x-tables::cell>
				Номер телефона
			</x-tables::cell>
			<x-tables::cell>
				{{ $questionTelephone }}
			</x-tables::cell>
		</x-tables::row>
	</x-mail::table>
</x-mail::panel>
