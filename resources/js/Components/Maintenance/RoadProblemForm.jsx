import React from 'react';
import { useForm } from '@inertiajs/react';
import clsx from 'clsx';

import TextInput from '../Shared/TextInput';
import ImageInput from '../Shared/ImageInput';
import FormField from '../Shared/FormField';
import PrivacyLink from '../Information/PrivacyLink';

const initialFormData = {
	address: '',
	comment: '',
	telephone: '',
	images: [],
};

const RoadProblemForm = (
	{
		className = '',
		onSuccess = () => {
		},
	},
) => {
	const { data, setData, post, processing, errors, clearErrors, reset } = useForm(initialFormData);

	const handleSubmit = (event) => {
		event.preventDefault();

		post(route('client.maintenance.road_problem.store'), {
			onSuccess: () => {
				reset();
				onSuccess();
			},
		});
	};

	return (
		<form className={clsx('form', className)} onSubmit={handleSubmit}>
			<FormField label='Где обнаружено замечание (яма и т.д)' error={errors.address}>
				<TextInput placeholder='Адрес' value={data.address} invalid={Boolean(errors.address)}
						   onChange={(event) => {
							   clearErrors('address');
							   setData('address', event.target.value);
						   }} />
			</FormField>
			<FormField label='Комментарий' error={errors.comment}>
				<TextInput type='textarea' placeholder='Опишите проблему' value={data.comment}
						   invalid={Boolean(errors.comment)}
						   onChange={(event) => {
							   clearErrors('comment');
							   setData('comment', event.target.value);
						   }} />
			</FormField>
			<FormField label='Номер телефона' error={errors.telephone}>
				<TextInput type='tel' placeholder='+7 (___) ___-__-__' value={data.telephone} mask='+7 (999) 999-99-99'
						   invalid={Boolean(errors.telephone)}
						   onChange={(event) => {
							   clearErrors('telephone');
							   setData('telephone', event.target.value);
						   }} />
			</FormField>
			<FormField error={errors.images}>
				<ImageInput label='Прикрепить фото' value={data.images} invalid={Boolean(errors.images)}
							onChange={(images) => {
								clearErrors('images');
								setData('images', images);
							}} />
			</FormField>
			<PrivacyLink className="form__privacy" />
			<button type='submit' disabled={processing} className='button button--accent'>
				Отправить замечание
			</button>
		</form>
	);
};

export default RoadProblemForm;
