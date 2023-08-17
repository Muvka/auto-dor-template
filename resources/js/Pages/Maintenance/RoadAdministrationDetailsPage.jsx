import React from 'react';
import { Head } from '@inertiajs/react';

import RoadAdministrationDetails from '../../Components/Maintenance/RoadAdministrationDetails';

const RoadAdministrationDetailsPage = ({ title = '', roadAdministration = {} }) => {
	return (
		<>
			<Head>
				<title>{title}</title>
			</Head>
			<h1 className='title container page-content__title'>{title}</h1>
			{Boolean(Object.keys(roadAdministration).length) && (
				<RoadAdministrationDetails {...roadAdministration} className="container" />
			)}
		</>
	);
};

export default RoadAdministrationDetailsPage;
