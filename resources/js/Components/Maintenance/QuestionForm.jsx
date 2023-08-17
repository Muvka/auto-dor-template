import React from 'react';
import { useForm, usePage } from '@inertiajs/react';
import clsx from 'clsx';

import FormField from '../Shared/FormField';
import SelectPicker from '../Shared/SelectPicker';
import TextInput from '../Shared/TextInput';
import ImageInput from '../Shared/ImageInput';
import PrivacyLink from '../Information/PrivacyLink';

const initialFormData = {
	subject: '',
	text: '',
	telephone: '',
	images: [],
};

const QuestionForm = (
	{
		className = '',
		onSuccess = () => {
		},
	},
) => {
	const { subjects } = usePage().props;
	const { data, setData, post, processing, errors, clearErrors, reset } = useForm(initialFormData);

	const handleSubmit = (event) => {
		event.preventDefault();

		post(route('client.maintenance.question.store'), {
			onSuccess: () => {
				reset();
				onSuccess();
			},
		});
	};

	return (
		<form className={clsx('form', className)} onSubmit={handleSubmit}>
			<FormField label='Тема обращения' error={errors.subject}>
				<SelectPicker placeholder="Выберите тему" value={data.subject} options={subjects} invalid={Boolean(errors.subject)}
							  onChange={(event) => {
								  clearErrors('subject');
								  setData('subject', event.target.value);
							  }} />
			</FormField>
			<FormField label='Ваш вопрос' error={errors.text}>
				<TextInput type='textarea' placeholder='Текст вопроса' value={data.text}
						   invalid={Boolean(errors.text)}
						   onChange={(event) => {
							   clearErrors('text');
							   setData('text', event.target.value);
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

export default QuestionForm;
