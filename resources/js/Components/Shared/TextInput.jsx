import React from 'react';
import clsx from 'clsx';
import InputMask from 'react-input-mask';

const TextInput = (
	{
		placeholder = undefined,
		value = '',
		mask = undefined,
		type = 'text',
		rows = 4,
		invalid = false,
		id = undefined,
		className = '',
		ariaLabel = undefined,
		onChange = () => {
		},
		onInput = () => {
		},
	},
) => {
	const Component = mask ? InputMask : 'input';

	return type === 'textarea' ? (
		<textarea id={id} placeholder={placeholder} value={value} rows={rows}
				  className={clsx('text-input', 'text-input--textarea', {
					  'text-input--invalid': invalid,
				  }, className)} aria-label={ariaLabel} onChange={onChange} onInput={onInput} />
	) : (
		<Component id={id} type={type} placeholder={placeholder} value={value} mask={mask}
				   className={clsx('text-input', {
					   'text-input--invalid': invalid,
				   }, className)} aria-label={ariaLabel} onChange={onChange} onInput={onInput} />
	);
};

export default TextInput;
