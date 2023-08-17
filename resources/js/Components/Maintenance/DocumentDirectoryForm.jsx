import React, { useId } from 'react';
import { useForm, usePage } from '@inertiajs/react';
import clsx from 'clsx';

import FormField from '../Shared/FormField';
import TextInput from '../Shared/TextInput';
import plusIconId from '../../../images/shared/icons/icon-plus.svg';

const DocumentDirectoryForm = ({ className = '' }) => {
	const { path = '' } = usePage().props;
	const {
		data,
		setData,
		post,
		processing,
		hasErrors,
		errors,
		clearErrors,
		reset,
	} = useForm({
		name: '',
	});
	const titleId = useId();

	const createDirectory = (event) => {
		event.preventDefault();

		post(route('client.maintenance.documents.store', path), {
			only: ['files', 'errors'],
			preserveScroll: true,
			onSuccess: () => {
				reset();
			},
		});
	};

	return (
		<div className={clsx('document-directory-form', className)} aria-labelledby={titleId}>
			<h3 id={titleId} className='title title--small document-directory-form__title'>Создать директорию</h3>
			<form className='form document-directory-form__form' onSubmit={createDirectory}>
				<FormField label='Название директории' hiddenLabel error={errors.name}>
					<TextInput value={data.name} placeholder='Название директории' invalid={Boolean(errors.name)}
							   className='document-directory-form__input'
							   onInput={(event) => {
								   clearErrors('name');
								   setData('name', event.target.value);
							   }} />
				</FormField>
				<button type='submit' disabled={processing} className={clsx('document-directory-form__submit', {
					'document-directory-form__submit--inactive': hasErrors,
				})}
						aria-label='Создать'>
					<svg width='16' height='16' className='document-directory-form__submit-icon' aria-hidden='true'>
						<use xlinkHref={`#${plusIconId}`} />
					</svg>
				</button>
			</form>
		</div>
	);
};

export default DocumentDirectoryForm;
