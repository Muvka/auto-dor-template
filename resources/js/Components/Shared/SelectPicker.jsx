import React from 'react';
import clsx from 'clsx';

const SelectPicker = (
	{
		placeholder = 'Выберите',
		value = '',
		options = [],
		invalid = false,
		id = undefined,
		className = '',
		onChange = () => {
		},
	},
) => {
	return (
		<select id={id} value={value} className={clsx('select-picker', {
			'select-picker--placeholder': !value,
			'select-picker--invalid': invalid,
		}, className)} onChange={onChange}>
			{Boolean(placeholder) && <option value="" disabled hidden>{placeholder}</option>}
			{options.map((option) => (
				<option key={option} value={option}>{option}</option>
			))}
		</select>
	);
};

export default SelectPicker;
