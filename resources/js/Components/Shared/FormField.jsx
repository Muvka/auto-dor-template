import React, { useId } from 'react';
import clsx from 'clsx';

const FormField = (
	{
		children = null,
		label = '',
		hiddenLabel = false,
		error = '',
		className = '',
	},
) => {
	const inputId = useId();

	if (!children) {
		return null;
	}

	const childrenWithProps = React.cloneElement(children, {
		id: Boolean(label) ? inputId : undefined,
		className: clsx(children.props?.className, 'form-field__input'),
	});

	return (
		<div className={clsx('form-field', className)}>
			{Boolean(label) && <label htmlFor={inputId} className={clsx('form-field__label', {
				'visually-hidden': hiddenLabel,
			})}>{label}</label>}
			{childrenWithProps}
			{Boolean(error) && <p className='form-field__error-message'>{error}</p>}
		</div>
	);
};

export default FormField;
