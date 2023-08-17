import React from 'react';
import clsx from 'clsx';

import printIconId from '../../../images/shared/icons/icon-print.svg';

const PrintButton = ({ className = '' }) => {
	return (
		<button className={clsx('print-button', className)}
				onClick={window.print}>
			<svg width='20' height='20' className='print-button__icon' aria-hidden='true'>
				<use xlinkHref={`#${printIconId}`} />
			</svg>
			Печать
		</button>
	);
};

export default PrintButton;
