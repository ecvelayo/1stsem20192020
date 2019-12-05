import React from 'react';
import { makeStyles } from '@material-ui/core/styles';
import Card from '@material-ui/core/Card';
import CardActions from '@material-ui/core/CardActions';
import CardContent from '@material-ui/core/CardContent';
import Button from '@material-ui/core/Button';
import Typography from '@material-ui/core/Typography';
import CardHeader from '@material-ui/core/CardHeader';
import MoreVertIcon from '@material-ui/icons/MoreVert';
import IconButton from '@material-ui/core/IconButton';
import EditRoundedIcon from '@material-ui/icons/EditRounded';
import DeleteRoundedIcon from '@material-ui/icons/DeleteRounded';

const useStyles = makeStyles({
	card: {
		minWidth: 275,
		position: 'relative'
	},
	title: {
		fontSize: 14
	}
});

export default function QuestionCard({ correct, question }) {
	const classes = useStyles();
	return (
		<Card className={`${classes.card} my-2`}>
			<div className='d-flex'>
				<div className='flex-grow-1'>
					<CardContent>
						<Typography
							className={classes.title}
							color='textSecondary'
							gutterBottom
						>
							{question}
						</Typography>
						<Typography variant='h5' component='h2'>
							{correct}
						</Typography>
						{/* <Typography variant='body2' component='p'>
                    other answer
                </Typography> */}
					</CardContent>
				</div>
				<div className='p-2 d-flex flex-column'>
					{/* <IconButton
						onClick={() => {
							alert('edit');
						}}
					>
						<EditRoundedIcon fontSize='small' />
					</IconButton>
					<IconButton
						onClick={() => {
							alert('delete');
						}}
					>
						<DeleteRoundedIcon fontSize='small' />
					</IconButton> */}
				</div>
			</div>
		</Card>
	);
}
