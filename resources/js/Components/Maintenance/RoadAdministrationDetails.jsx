import React from 'react';
import clsx from 'clsx';

import PrintButton from '../Shared/PrintButton';
import DescriptionList from '../Shared/DescriptionList';
import DescriptionItem from '../Shared/DescriptionItem';

const RoadAdministrationDetails = (
	{
		sections = [],
		vacancies = [],
		totalConstructionEquipmentNumber = 0,
		totalExploitationEquipmentNumber = 0,
		totalOtherEquipmentNumber = 0,
		employeesNumber = 0,
		employeesDocument = undefined,
		maintainedRoadsLength = 0,
		buildingsNumber = 0,
		buildingsMapUrl = '',
		asphaltPlantsNumber = 0,
		asphaltPlantsMapUrl = '',
		className = '',
	},
) => {
	return (
		<div className={clsx('detailed-information', className)}>
			<DescriptionList className='detailed-information__list detailed-information__list--narrow'>
				<DescriptionItem term='Количество участков:' definition={sections.length} />
				{Boolean(sections.length) && (
					<DescriptionItem term='Наименование участков:'
									 definition={sections.map((section) => section.name)} />
				)}
				<DescriptionItem term='Количество сотрудников:'
								 definition={employeesNumber} />
				{Boolean(employeesDocument) && (
					<DescriptionList.Item term='ФИО и должности сотрудников:'>
						<a href={employeesDocument.url} className='link'>{employeesDocument.name}</a>
					</DescriptionList.Item>
				)}
				{Boolean(vacancies.length) && (
					<DescriptionItem term='Список вакансий:'>
						<table className='table'>
							<thead>
							<tr className='table__row'>
								<th className='table__cell table__cell--head'>Вакансия</th>
								<th className='table__cell table__cell--head table__cell--right'>Кол-во</th>
							</tr>
							</thead>
							<tbody>
							{vacancies.map((vacancy) => (
								<tr key={vacancy.id} className='table__row'>
									<td className='table__cell'>{vacancy.name}</td>
									<td className='table__cell table__cell--right'>{vacancy.number}</td>
								</tr>
							))}
							</tbody>
						</table>
					</DescriptionItem>
				)}
				<DescriptionItem term='Количество дорожной техники (строительство):'
								 definition={totalConstructionEquipmentNumber} />
				<DescriptionItem term='Количество дорожной техники (эксплуатация):'
								 definition={totalExploitationEquipmentNumber} />
				<DescriptionItem term='Количество техники (другая, тралы, самосвалы, автобусы):'
								 definition={totalOtherEquipmentNumber} />
				<DescriptionItem term='Протяженность обслуживаемых дорог' definition={`${maintainedRoadsLength} км`} />
				<DescriptionItem term='Количество зданий, сооружений' definition={buildingsNumber}>
					{Boolean(buildingsMapUrl) && (
						<a href={buildingsMapUrl} target='_blank' rel='nofollow noopener noreferrer'
						   className='link'>Смотреть на карте</a>
					)}
				</DescriptionItem>
				<DescriptionItem term='Количество АБЗ' definition={asphaltPlantsNumber}>
					{Boolean(asphaltPlantsMapUrl) && (
						<a href={asphaltPlantsMapUrl} target='_blank' rel='nofollow noopener noreferrer'
						   className='link'>Смотреть на карте</a>
					)}
				</DescriptionItem>
			</DescriptionList>
			<PrintButton className='detailed-information__print' />
		</div>
	);
};

export default RoadAdministrationDetails;
