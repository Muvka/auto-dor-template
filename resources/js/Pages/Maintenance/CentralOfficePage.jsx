import React from 'react';
import { Head } from '@inertiajs/react';

import DescriptionList from '../../Components/Shared/DescriptionList';
import PrintButton from '../../Components/Shared/PrintButton';

const CentralOfficePage = (
	{
		title = '',
		centralOffice = {},
		roadAdministrations = [],
	},
) => {
	const {
		employeesNumber = 0,
		employeesDocument = '',
		totalBuildingsNumber = 0,
		buildingsNumber = 0,
		buildingsMapUrl = '',
		asphaltPlantsNumber = 0,
		asphaltPlantsMapUrl = '',
		maintainedRoadsLength = 0,
		totalEquipmentNumber = 0,
		totalConstructionEquipmentNumber = 0,
		totalExploitationEquipmentNumber = 0,
		totalOtherEquipmentNumber = 0,
		...equipment
	} = centralOffice;

	return (
		<>
			<Head>
				<title>{title}</title>
			</Head>
			<h1 className='title page-content__title container'>{title}</h1>
			<div className='detailed-information container'>
				<DescriptionList className='detailed-information__list detailed-information__list--narrow'>
					<DescriptionList.Item term='Количество сотрудников:' definition={employeesNumber} />
					{Boolean(employeesDocument) && (
						<DescriptionList.Item term='ФИО и должности сотрудников:'>
							<a href={employeesDocument.url} className='link'>{employeesDocument.name}</a>
						</DescriptionList.Item>
					)}
					<DescriptionList.Item term='Количество техники:' definition={totalEquipmentNumber}>
						<table className='table'>
							<thead>
							<tr className='table__row'>
								<th className='table__cell table__cell--head'>Машины и механизмы</th>
								<th className='table__cell table__cell--head table__cell--right'>Кол-во шт.</th>
							</tr>
							</thead>
							<tbody>
							<tr className='table__row'>
								<td className='table__cell'>Легковые</td>
								<td className='table__cell table__cell--right'>{equipment.passengerCarsNumber}</td>
							</tr>
							<tr className='table__row'>
								<td className='table__cell'>Самосвалы</td>
								<td className='table__cell table__cell--right'>{equipment.dumpTrucksNumber}</td>
							</tr>
							<tr className='table__row'>
								<td className='table__cell'>КДМ</td>
								<td className='table__cell table__cell--right'>{equipment.kdmNumber}</td>
							</tr>
							<tr className='table__row'>
								<td className='table__cell'>Автогрейдеры</td>
								<td className='table__cell table__cell--right'>{equipment.motorGradersNumber}</td>
							</tr>
							<tr className='table__row'>
								<td className='table__cell'>Фронтальные погрузчики</td>
								<td className='table__cell table__cell--right'>{equipment.frontLoadersNumber}</td>
							</tr>
							<tr className='table__row'>
								<td className='table__cell'>Трактора колесные</td>
								<td className='table__cell table__cell--right'>{equipment.wheeledTractorsNumber}</td>
							</tr>
							<tr className='table__row'>
								<td className='table__cell'>Трактора гусеничные</td>
								<td className='table__cell table__cell--right'>{equipment.caterpillarTractorsNumber}</td>
							</tr>
							<tr className='table__row'>
								<td className='table__cell'>Катки самоходы</td>
								<td className='table__cell table__cell--right'>{equipment.roadRollersNumber}</td>
							</tr>
							<tr className='table__row'>
								<td className='table__cell'>Экскаваторы</td>
								<td className='table__cell table__cell--right'>{equipment.excavatorsNumber}</td>
							</tr>
							<tr className='table__row'>
								<td className='table__cell'>Автобусы</td>
								<td className='table__cell table__cell--right'>{equipment.busesNumber}</td>
							</tr>
							<tr className='table__row'>
								<td className='table__cell'>Прицепы</td>
								<td className='table__cell table__cell--right'>{equipment.trailersNumber}</td>
							</tr>
							<tr className='table__row'>
								<td className='table__cell'>Прицепное оборудование</td>
								<td className='table__cell table__cell--right'>{equipment.trailerEquipmentsNumber}</td>
							</tr>
							<tr className='table__row'>
								<td className='table__cell'>Эвакуаторы</td>
								<td className='table__cell table__cell--right'>{equipment.towTrucksNumber}</td>
							</tr>
							<tr className='table__row'>
								<td className='table__cell'>Асфальтоукладчики</td>
								<td className='table__cell table__cell--right'>{equipment.paversNumber}</td>
							</tr>
							<tr className='table__row'>
								<td className='table__cell'>Гудронаторы</td>
								<td className='table__cell table__cell--right'>{equipment.distributorsNumber}</td>
							</tr>
							<tr className='table__row'>
								<td className='table__cell'>Другая техника (cтроительство)</td>
								<td className='table__cell table__cell--right'>{equipment.otherConstructionNumber}</td>
							</tr>
							<tr className='table__row'>
								<td className='table__cell'>Другая техника (эксплуатация)</td>
								<td className='table__cell table__cell--right'>{equipment.otherExploitationNumber}</td>
							</tr>
							<tr className='table__row'>
								<td className='table__cell'>Другая техника</td>
								<td className='table__cell table__cell--right'>{equipment.otherOtherNumber}</td>
							</tr>
							</tbody>
						</table>
					</DescriptionList.Item>
					<DescriptionList.Item term='Здания и сооружения АО «Вятавтодор»:'
										  definition={totalBuildingsNumber} />
					<DescriptionList.Item term='Количество ДУ:' definition={roadAdministrations.length}>
						<table className='table'>
							<thead>
							<tr className='table__row'>
								<th className='table__cell table__cell--head'>Дорожные управления</th>
								<th className='table__cell table__cell--head table__cell--right'>Кол-во участков</th>
							</tr>
							</thead>
							<tbody>
							{roadAdministrations.map((roadAdministration) => (
								<tr key={roadAdministration.id} className='table__row'>
									<td className='table__cell'>{roadAdministration.name}</td>
									<td className='table__cell table__cell--right'>{roadAdministration.sections}</td>
								</tr>
							))}
							</tbody>
						</table>
					</DescriptionList.Item>
					<DescriptionList.Item term='Количество дорожной техники (строительство):'
										  definition={totalConstructionEquipmentNumber} />
					<DescriptionList.Item term='Количество дорожной техники (эксплуатация):'
										  definition={totalExploitationEquipmentNumber} />
					<DescriptionList.Item term='Количество дорожной техники (другая: тралы, самосвалы, автобусы):'
										  definition={totalOtherEquipmentNumber} />
					<DescriptionList.Item term='Протяженность обслуживаемых дорог:'
										  definition={`${maintainedRoadsLength} км`} />
					<DescriptionList.Item term='Количество зданий, сооружений, в том числе и по ДУ:'
										  definition={buildingsNumber}>
						{Boolean(buildingsMapUrl) && (
							<a href={buildingsMapUrl} target='_blank' rel='nofollow noopener noreferrer'
							   className='link'>
								Смотреть на карте
							</a>
						)}
					</DescriptionList.Item>
					<DescriptionList.Item term='Количество АБЗ:' definition={asphaltPlantsNumber}>
						{Boolean(asphaltPlantsMapUrl) && (
							<a href={asphaltPlantsMapUrl} target='_blank' rel='nofollow noopener noreferrer'
							   className='link'>
								Смотреть на карте
							</a>
						)}
					</DescriptionList.Item>
				</DescriptionList>
				<PrintButton className='detailed-information__print' />
			</div>
		</>
	);
};

export default CentralOfficePage;
