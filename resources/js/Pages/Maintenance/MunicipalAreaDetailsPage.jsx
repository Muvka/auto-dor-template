import React from 'react';
import { Head } from '@inertiajs/react';

import RoadSectionDetails from '../../Components/Maintenance/RoadSectionDetails';

const MunicipalAreaDetailsPage = (
	{
		title = '',
		roadSection = {},
	},
) => {
	return (
		<>
			<Head>
				<title>{title}</title>
			</Head>
			<h1 className='title page-content__title container'>{title}</h1>
			{Boolean(Object.keys(roadSection).length) && (
				<RoadSectionDetails {...roadSection} className='container' />
			)}
		</>
	);
};

export default MunicipalAreaDetailsPage;
