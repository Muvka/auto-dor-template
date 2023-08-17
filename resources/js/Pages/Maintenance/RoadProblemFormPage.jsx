import React, { useState } from 'react';
import { Head } from '@inertiajs/react';

import RoadProblemForm from '../../Components/Maintenance/RoadProblemForm';
import SuccessNotification from '../../Components/Shared/SuccessNotification';

const RoadProblemFormPage = ({ title = '' }) => {
	const [isFormSent, setIsFormSent] = useState(false);

	return (
		<>
			<Head>
				<title>{title}</title>
			</Head>
			<h1 className='title container page-content__title page-content__title--big-margin'>
				{title}
			</h1>
			{isFormSent ? (
				<SuccessNotification className='container container--narrow' />
			) : (
				<RoadProblemForm className='container container--narrow' onSuccess={() => setIsFormSent(true)} />
			)}
		</>
	);
};

export default RoadProblemFormPage;
