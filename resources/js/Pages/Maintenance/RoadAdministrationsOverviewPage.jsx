import React from "react";
import { Head } from '@inertiajs/react';
import RoadAdministrationList from '../../Components/Maintenance/RoadAdministrationList';

const RoadAdministrationsOverviewPage = ({title = '', roadAdministrations = []}) => {
	return (
		<>
			<Head>
				<title>{title}</title>
			</Head>
			<h1 className="title container page-content__title">{title}</h1>
			{Boolean(roadAdministrations.length) && (
				<RoadAdministrationList administrations={roadAdministrations} className="container" />
			)}
		</>
	);
};

export default RoadAdministrationsOverviewPage;
