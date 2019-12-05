import React from 'react';
import Axios from 'axios';
import CardContainer from './Training/CardContainer';
import BlankImg from '../../img/undraw_blank_canvas.svg';
import LinearProgress from '@material-ui/core/LinearProgress';

// class component
export default class UserEnrolledTrainings extends React.Component {
    state = {
        enrolledTraining: []
    };
    componentDidMount = () => {
        Axios.get(`/api/enrolled/trainings/${this.props.id}`).then(response => {
            this.setState({
                enrolledTraining: response.data
            });
        });
    };

    render() {
        return (
            <div className='container my-5'>
                <h2 className='text-center'>User Enrolled trainings</h2>
                <div className='row'>
                    <div className='col-md-6'>
                        <h5>Ongoing</h5>
                        {this.state.enrolledTraining.length > 0
                            ? this.state.enrolledTraining
                                  .filter(training => {
                                      return !training.is_completed;
                                  })
                                  .map(row => {
                                      console.log(row);
                                      return (
                                          <CardContainer
                                              className='card'
                                              key={row.training.id}
                                          >
                                              <div
                                                  className={`d-flex justify-content-center ${
                                                      !row.training.image
                                                          ? 'border-bottom'
                                                          : ''
                                                  }`}
                                              >
                                                  <img
                                                      src={
                                                          row.training.image
                                                              ? `/storage/trainings/${row.training.image}`
                                                              : BlankImg
                                                      }
                                                      alt='image'
                                                      className='card-img-top'
                                                  />
                                              </div>
                                              <div className='card-body text-truncate'>
                                                  <h5 className='mb-0'>
                                                      {row.training.title}
                                                  </h5>
                                              </div>
                                              <div>
                                                  <LinearProgress
                                                      color='primary'
                                                      variant='determinate'
                                                      value={
                                                          row.progress
                                                              ? row.progress
                                                              : 0
                                                      }
                                                      size={'10rem'}
                                                  />
                                                  <div className='font-italize text-center small'>
                                                      Progress
                                                  </div>
                                              </div>
                                          </CardContainer>
                                      );
                                  })
                            : null}
                    </div>
                    <div className='col-md-6'>
                        <h5>Finished</h5>
                        {this.state.enrolledTraining.length > 0
                            ? this.state.enrolledTraining
                                  .filter(training => {
                                      return training.is_completed;
                                  })
                                  .map(row => {
                                      return (
                                          <CardContainer
                                              className='card'
                                              key={row.training.id}
                                          >
                                              <div
                                                  className={`d-flex justify-content-center ${
                                                      !row.training.image
                                                          ? 'border-bottom'
                                                          : ''
                                                  }`}
                                              >
                                                  <img
                                                      src={
                                                          row.training.image
                                                              ? `/storage/trainings/${row.training.image}`
                                                              : BlankImg
                                                      }
                                                      alt='image'
                                                      className='card-img-top'
                                                  />
                                              </div>
                                              <div className='card-body text-truncate'>
                                                  <h5 className='mb-0'>
                                                      {row.training.title}
                                                  </h5>
                                              </div>
                                          </CardContainer>
                                      );
                                  })
                            : null}
                    </div>
                </div>
            </div>
        );
    }
}
