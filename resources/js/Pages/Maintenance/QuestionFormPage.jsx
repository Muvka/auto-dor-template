import React, { useState } from 'react';
import { Head } from '@inertiajs/react';
import SuccessNotification from '../../Components/Shared/SuccessNotification';
import QuestionForm from '../../Components/Maintenance/QuestionForm';

const QuestionFormPage = ({ title = '' }) => {
	const [isFormSent, setIsFormSent] = useState(false);

	return (
		<>
			<Head>
				<title>{title}</title>
			</Head>
			<h1 className='title container page-content__title page-content__title--big-margin'>{title}</h1>
			{isFormSent ? (
				<SuccessNotification className='container container--narrow' />
			) : (
				<QuestionForm className='container container--narrow' onSuccess={() => setIsFormSent(true)} />
			)}
		</>
	);
};

export default QuestionFormPage;
