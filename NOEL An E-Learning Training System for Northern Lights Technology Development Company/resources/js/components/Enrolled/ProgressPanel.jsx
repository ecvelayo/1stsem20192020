import React from 'react';
import Skeleton from 'react-loading-skeleton';
import LinearProgress from '@material-ui/core/LinearProgress';
import { Row, Col, Button } from 'reactstrap';
import { Link } from 'react-router-dom';
import { PDFExport } from '@progress/kendo-react-pdf';
import { MainContainer } from '../Certificate/EditCertificate';
import Axios from 'axios';

export default class ProgressPanel extends React.Component {
    pdfExportComponent;
    state = {
        PDFdata: {}
    };
    componentDidMount = () => {
        const { enrolled } = this.props;
        let name = enrolled.user.fname + ' ' + enrolled.user.lname;
        let certInfo = {};
        Axios.get(`/api/get/certificate/${enrolled.training.id}`)
            .then(response => {
                certInfo = response.data;
                let data = {
                    user: name,
                    training: {
                        title: enrolled.training.title
                    },
                    date_completed: enrolled.date_completed,
                    hr: certInfo.hr,
                    admin: certInfo.admin,
                    background: certInfo.background
                };
                this.setState({
                    PDFdata: data
                });
            })
            .catch(error => {
                console.log(error.response);
            });
    };
    render() {
        let {
            enrolled,
            enrolled: { current }
        } = this.props;
        const PDFPreview = () => {
            if (enrolled.is_completed) {
                return (
                    <div
                        style={{
                            position: 'absolute',
                            left: '-1000px',
                            top: '0'
                        }}
                    >
                        {Object.keys(this.state.PDFdata).length !== 0 ? (
                            <PDFExport
                                paperSize={'Letter'}
                                fileName={`${this.state.PDFdata.training.title} Certificate.pdf`}
                                landscape={true}
                                imageResolution={72}
                                ref={c => (this.pdfExportComponent = c)}
                            >
                                <MainContainer data={this.state.PDFdata} />
                            </PDFExport>
                        ) : null}
                    </div>
                );
            } else {
                return null;
            }
        };
        let currentLectureTitle;
        if (current) {
            current = JSON.parse(current);
            enrolled.training.sections
                .filter(section => {
                    return section.id === current.current.section;
                })
                .map(section => {
                    section.lectures
                        .filter(lecture => {
                            return lecture.id === current.current.lecture;
                        })
                        .map(({ title }) => {
                            currentLectureTitle = title;
                        });
                });
        }
        return (
            <div className='p-3'>
                <h3>
                    {enrolled.training && enrolled.training.title ? (
                        enrolled.training.title
                    ) : (
                        <Skeleton />
                    )}
                </h3>
                <Row>
                    <Col>
                        <div className='my-3'>
                            <Row>
                                <Col>
                                    <h6>Current progress </h6>
                                    <div>
                                        <h5>
                                            {(enrolled.progress === 0
                                                ? '0%'
                                                : `${Math.round(
                                                      enrolled.progress
                                                  )}%`) || <Skeleton />}
                                        </h5>
                                    </div>
                                    <LinearProgress
                                        color='primary'
                                        variant='determinate'
                                        value={
                                            enrolled.progress
                                                ? enrolled.progress
                                                : 0
                                        }
                                        size={'10rem'}
                                    />
                                </Col>
                                <Col>
                                    <h6 className='mb-2'>Current topic</h6>
                                    <div>
                                        <h5>
                                            {currentLectureTitle == null ? (
                                                <span className='text-muted font-italic small'>
                                                    Not yet started
                                                </span>
                                            ) : (
                                                currentLectureTitle || (
                                                    <Skeleton />
                                                )
                                            )}
                                        </h5>
                                    </div>
                                </Col>
                            </Row>
                        </div>
                        <div className='my-3'>
                            <Link
                                to={`/progress/${enrolled.id}`}
                                className={`btn ${
                                    enrolled.is_completed
                                        ? 'btn-outline-light border text-muted'
                                        : 'btn-primary'
                                }`}
                            >
                                {enrolled.current === null
                                    ? 'Start training'
                                    : 'Continue training'}
                            </Link>
                            {enrolled.is_completed ? (
                                <Button
                                    color='primary'
                                    className='mx-3'
                                    onClick={() => {
                                        this.pdfExportComponent.save();
                                    }}
                                >
                                    Get Certificate
                                </Button>
                            ) : null}
                        </div>
                    </Col>
                </Row>
                <div className='small mt-4'>Training Details</div>
                <hr />
                {this.props.children}
                {<PDFPreview /> || null}
            </div>
        );
    }
}
